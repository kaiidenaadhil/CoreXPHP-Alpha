<?php



function parseJsonToDataAndFields(string $json): array {
    $schema = json_decode($json, true);

    if (!is_array($schema)) {
        throw new Exception("Invalid JSON schema.");
    }

    $rules = [];
    $fields = [];
    $fileFields = [];
    $specialFields = [];

    foreach ($schema as $field => $ruleString) {
        $fieldRules = [];
        $rulesArray = explode("|", $ruleString);
        $fileExtensions = [];

        foreach ($rulesArray as $rule) {
            $ruleParts = explode(":", $rule, 2);
            $ruleName = $ruleParts[0];
            $ruleValue = $ruleParts[1] ?? null;

            switch ($ruleName) {
                case "string":
                case "integer":
                case "decimal":
                case "double":
                case "float":
                case "boolean":
                    $fieldRules[] = "required";
                    break;

                case "max":
                case "min":
                    if ($ruleValue !== null) {
                        $fieldRules[] = "$ruleName:$ruleValue";
                    }
                    break;

                case "nullable":
                case "unique":
                    $fieldRules[] = $ruleName;
                    break;

                case "primary_key":
                case "auto_increment":
                    $specialFields[$field][$ruleName] = true;
                    break;

                case "enum":
                    if ($ruleValue !== null) {
                        $allowed = explode(",", $ruleValue);
                        $fieldRules[] = "in:" . implode(",", $allowed);
                    }
                    break;

                case "foreign":
                    if (!empty($ruleValue)) {
                        // Exploding by colon instead of comma (for the format: "foreign:table:column")
                        $ruleParts = array_map('trim', explode(":", $ruleValue));

                        if (count($ruleParts) === 2) {
                            // Unpack only if we have exactly two elements: table and column
                            [$table, $column] = $ruleParts;
                            $specialFields[$field]['foreign'] = [
                                'table' => $table,
                                'column' => $column,
                            ];
                        } else {
                            throw new Exception("Invalid foreign key format for '{$field}'. It should be 'table:column'.");
                        }
                    }
                    break;

                case "file":
                    $fieldRules[] = "file";

                    if ($ruleValue === "*") {
                        $fileExtensions = [
                            'jpg', 'jpeg', 'png', 'webp', 'gif',
                            'pdf', 'doc', 'docx', 'mp3', 'mp4'
                        ];
                    } elseif (!empty($ruleValue)) {
                        $fileExtensions = explode(",", $ruleValue);
                    }
                    break;

                default:
                    break;
            }
        }

        // Clean up file extensions if any were set
        if (!empty($fileExtensions)) {
            $fileFields[$field] = array_unique(array_map(function ($ext) {
                return trim(str_replace("file:", "", $ext));
            }, $fileExtensions));
        }

        // Combine the individual field rules into a single rule string
        $rules[$field] = implode("|", array_unique($fieldRules));
        $fields[] = $field;
    }

    return [$rules, $fields, $fileFields, $specialFields];
}



function createController($subscriber, $printRules, $printColumns, $fileFields = []) {
    $smodel = singularize($subscriber);
    $code = "<?php\n";
    $code .= "class {$subscriber}Controller extends Controller\n";
    $code .= "{\n";
    $code .= "    public function {$subscriber}Index()\n";
    $code .= "    {\n";
    $code .= "        \$search = isset(\$_GET['search']) ? \$_GET['search'] : '';\n";
    $code .= "        \${$subscriber}Model = \$this->model('{$subscriber}Model');\n";
    $code .= "        \t\$searchColumns = " . var_export($printColumns, true) . ";\n";
    $code .= "        \$totalRecords = \${$subscriber}Model->countAll(\$search, \$searchColumns);\n";
    $code .= "        \$page = isset(\$_GET['page']) ? (int)\$_GET['page'] : 1;\n";
    $code .= "        \$pagination = new Paginator(\$totalRecords, \$page, 10);\n";
    $code .= "        \$data = \${$subscriber}Model->displayAllSearch(\$search, \$searchColumns, \$pagination->getOffset(), \$pagination->getLimit());\n";
    $code .= "        \$params['{$subscriber}'] = \$data;\n";
    $code .= "        if (\$totalRecords > \$pagination->getLimit()) {\n";
    $code .= "            \$params['pagination'] =  \$pagination->render();\n";
    $code .= "        } else {\n";
    $code .= "            \$params['pagination'] = '';\n";
    $code .= "        }\n";
    $code .= "        \$this->adminView('{$subscriber}/{$subscriber}All', \$params);\n";
    $code .= "    }\n\n";
    //Display All
    $code .= "    public function {$subscriber}Display(Request \$request, \${$subscriber}Identify)\n";
    $code .= "    {\n";
    $code .= "        \${$subscriber}Model = \$this->model('{$subscriber}Model');\n";
    $code .= "        \$params['{$subscriber}'] =  \${$subscriber}Model->displaySingle(\${$subscriber}Identify);\n";
    $code .= "        \$this->adminView('{$subscriber}/{$subscriber}Single', \$params);\n";
    $code .= "    }\n\n";


$code .= "    public function {$subscriber}Destroy(Request \$request, \${$subscriber}Identify)\n";
$code .= "    {\n";
$code .= "        \${$subscriber}Model = \$this->model('{$subscriber}Model');\n";
$code .= "        \${$subscriber}Model->erase(\${$subscriber}Identify);\n";
$code .= "            // success delete and redirect\n";
$code .=  'header("Location:  " . ROOT . "/admin/' . $subscriber . '/");' . "\n";
$code .= "            \$_SESSION['success_message'] = \"Delete successful!\";\n";
$code .= "            exit;\n";

$code .= "    }\n\n";

    // build or Add a Record
    $code .= "    public function {$subscriber}build()\n";
    $code .= "    {\n";
    $code .= "        \$this->adminView('{$subscriber}/{$subscriber}New');\n";
    $code .= "    }\n\n";

// Process a adding record
    $code .= "    public function {$subscriber}Record(Request \$request)\n";
    $code .= "    {\n";
    $code .= "        \${$subscriber}Model = \$this->model('{$subscriber}Model');\n";
    $code .= "        \$data = \$request->getBody();\n";

    $code .= "        \$data['{$smodel}CreatedAt'] = date('Y-m-d H:i:s');\n";
    $code .= "        \$data['{$smodel}UpdatedAt'] = date('Y-m-d H:i:s');\n"; 
    $code .= "        \$data['{$smodel}Identify'] = generateUniqueId(16);\n";


// Handle file uploads dynamically
if (!empty($fileFields)) {
    $code .= "        // Handle file uploads\n";
    $code .= "        \$uploadsDir = '../public/assets/alpha-theme/img/uploads/';\n";
    $defaultExts = "['jpg','jpeg','png','webp','gif','pdf','doc','docx','mp3','mp4']";

    foreach ($fileFields as $fileField => $types) {
        $extList = ($types === '*' || $types === ['*']) 
            ? $defaultExts 
            : var_export($types, true);

        $code .= "        // Upload for {$fileField}\n";
        $code .= "        \$allowedExts = {$extList};\n";
        $code .= "        \$filename = uploadFile('{$fileField}', \$uploadsDir, \$allowedExts, 52428800, true);\n";
        $code .= "        if (\$filename) {\n";
        $code .= "            \$data['{$fileField}'] = \$filename;\n";
        $code .= "        } else {\n";
        $code .= "            echo \"Upload failed for {$fileField}!\";\n";
        $code .= "        }\n";
    }
    $code .= "\n";
}

// Handle file uploads dynamically

     $code .= "        \t\$rules = {$printRules};\n";
    $code .= "        \$validator = new Validator();\n";
    $code .= "        \$validator->validate(\$rules);\n";
    $code .= "        if (\$validator->fails()) {\n";
    $code .= "            \$errors = \$validator->errors();\n";
    $code .= "            foreach (\$errors as \$error) {\n";
    $code .= "                echo \$error . \"</br>\";\n";
    $code .= "            }\n";
    $code .= "        } else {\n";
    $code .= "            \${$subscriber}Model->record(\$data);\n";
    $code .= "            // success adding and redirect\n";
    $code .=                'header("Location:  " . ROOT . "/admin/' . $subscriber . '/");' . "\n";
    $code .= "            \$_SESSION['success_message'] = \"Added successful!\";\n";
    $code .= "            exit;\n";

    $code .= "        }\n";
    $code .= "    }\n\n";

// Updating Record
    $code .= "    public function {$subscriber}Modify(Request \$request,\${$subscriber}Identify)\n";
    $code .= "    {\n";
    $code .= "        \${$subscriber}Model = \$this->model('{$subscriber}Model');\n";
    $code .= "        \$params['{$smodel}Identify'] = \${$subscriber}Identify;\n";
    $code .= "        \$params['{$subscriber}'] =  \${$subscriber}Model->displaySingle(\${$subscriber}Identify);\n";
    $code .= "        \$this->adminView('{$subscriber}/{$subscriber}Edit', \$params);\n";
    $code .= "    }\n\n";

    // Edit Record.
    $code .= "    public function {$subscriber}Edit(Request \$request, \${$subscriber}Identify)\n";
    $code .= "    {\n";
    $code .= "        \${$subscriber}Model = \$this->model('{$subscriber}Model');\n";
    $code .= "        \$data = \$request->getBody();\n";

    // Handle file uploads dynamically
if (!empty($fileFields)) {
    $code .= "        // Handle file uploads\n";
    $code .= "        \$uploadsDir = '../public/assets/alpha-theme/img/uploads/';\n";
    $defaultExts = "['jpg','jpeg','png','webp','gif','pdf','doc','docx','mp3','mp4']";

    foreach ($fileFields as $fileField => $types) {
        $extList = ($types === '*' || $types === ['*']) 
            ? $defaultExts 
            : var_export($types, true);

        $code .= "        // Upload for {$fileField}\n";
        $code .= "        \$allowedExts = {$extList};\n";
        $code .= "        \$filename = uploadFile('{$fileField}', \$uploadsDir, \$allowedExts, 52428800, true);\n";
        $code .= "        if (\$filename) {\n";
        $code .= "            \$data['{$fileField}'] = \$filename;\n";
        $code .= "        }\n";

    }
    $code .= "\n";
}

// Handle file uploads dynamically


    $code .= "        \t\$rules = {$printRules};\n";
    $code .= "        \$validator = new Validator();\n\n";
    $code .= "        if (\$validator->fails(\$rules)) {\n";
    $code .= "            \$errors = \$validator->errors();\n";
    $code .= "            foreach (\$errors as \$error) {\n";
    $code .= "                echo \$error . \"</br>\";\n";
    $code .= "            }\n";
    $code .= "        } else {\n";
    $code .= "            \${$subscriber}Model->modify(\$data, \${$subscriber}Identify);\n";
    $code .= "            // success updated and redirect\n";
    $code .=  'header("Location:  " . ROOT . "/admin/' . $subscriber . '/");' . "\n";
    $code .= "            \$_SESSION['success_message'] = \"Update successful!\";\n";
    $code .= "            exit;\n";
    $code .= "        }\n";
    $code .= "    }\n";
    $code .= "}\n";

    file_put_contents("./../app/controllers/".ucfirst($subscriber).'Controller.php', $code);
    
    }




    function createModel($model, $printColumns)
    {
        $smodel = singularize($model);
    
        $code = "<?php\n";
        $code .= "class {$model}Model extends Model\n";
        $code .= "{\n\n";
    
        $code .= "\tpublic function record(\$data = [])\n";
        $code .= "\t{\n";
        $code .= "\t\t\$this->insert(\"{$model}\", \$data);\n";
        $code .= "\t}\n\n";
    
        $code .= "\tpublic function countAll(\$search, \$searchColumns)\n";
        $code .= "\t{\n";
        $code .= "\t\treturn \$this->searchCount(\"{$model}\", \$search, \$searchColumns);\n";
        $code .= "\t}\n\n";
    
        $code .= "\tpublic function displayAll(\$offset = null, \$limit = null)\n";
        $code .= "\t{\n";
        // Fix: Define the columns for displayAll
        $code .= "\t\t\$columns = " . var_export($printColumns, true) . ";\n";
        $code .= "\t\treturn \$this->paginate(\"{$model}\", \$columns, [], \$offset, \$limit);\n";
        $code .= "\t}\n\n";
    
        $code .= "\tpublic function displayAllSearch(\$search, \$searchColumns, \$offset = null, \$limit = null)\n";
        $code .= "\t{\n";
        // Fix: Define the columns for displayAllSearch
        $code .= "\t\t\$columns = " . var_export($printColumns, true) . ";\n";
        $code .= "\t\treturn \$this->search(\"{$model}\", \$columns, [], \$search, \$searchColumns, \$offset, \$limit);\n";
        $code .= "\t}\n\n";
    
        $code .= "\tpublic function displaySingle(\$id)\n";
        $code .= "\t{\n";
        $code .= "\t\t\$columns = " . var_export($printColumns, true) . ";\n";
        $code .= "\t\treturn \$this->select(\"{$model}\", \$columns, [\"{$smodel}Identify\" => \$id]);\n";
        $code .= "\t}\n\n";
    
        $code .= "\tpublic function modify(\$data, \$id)\n";
        $code .= "\t{\n";
        $code .= "\t\treturn \$this->updateWhere(\"{$model}\", \$data, [\"{$smodel}Identify\" => \$id]);\n";
        $code .= "\t}\n\n";
    
        $code .= "\tpublic function erase(\$id)\n";
        $code .= "\t{\n";
        $code .= "\t\treturn \$this->deleteWhere(\"{$model}\", [\"{$smodel}Identify\" => \$id]);\n";
        $code .= "\t}\n";
        $code .= "}\n";
        
        // Create the file in the models folder
        file_put_contents("./../app/models/" . $model . 'Model.php', $code);
    }
    



    

    
