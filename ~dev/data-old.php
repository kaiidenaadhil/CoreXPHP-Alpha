<?php
function p($value){
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  exit;
}

require_once './SchemaBuilder.php'; // MySQL,JSON creation
require_once './router.php'; // Router APPEND FUNCTION and Resource router
require_once './factory.php'; // Create Controller , Model with associative arrays
require_once './view.php'; // Create Dynamic Views 


if ($_SERVER['REQUEST_METHOD'] == "POST") {

  function addFieldsToJSONFile($table, $json) {
    $table = singularize($table);
    // Read the original JSON data
    $data = json_decode($json, true);
    // Add the new fields to the data array
    $data[$table.'CreatedAt'] = 'timestamp';
    $data[$table.'UpdatedAt'] = 'timestamp';
    $data[$table.'Identify'] = 'string|max:50';
    // Convert the data array back to JSON
    $json = json_encode($data, JSON_PRETTY_PRINT);
    // Return the updated JSON
    return $json;
  }

  $addFieldsToJSONFile = addFieldsToJSONFile($_POST['TABLE'],$_POST['JSON']);


/* Start of Creating Associative arrays from json */
list($rules, $searchColumns) = parseJsonToDataAndFields($addFieldsToJSONFile);

function funcRules($rules) {
    $rulesString = var_export(array_slice($rules, 1), true);
    return $rulesString ;
}

function funcColumns($searchColumns) {
    $searchColumnsString = var_export(array_slice($searchColumns, 0), true);
    return $searchColumnsString;
}

$getRules = funcRules($rules);
$getColumns = funcColumns($searchColumns);


/* End  of calling Associative arrays from json */


$tableSchema = json_decode($addFieldsToJSONFile, true);


//$tableSchema = json_decode($_POST['JSON'], true);
$table = $_POST['TABLE'];

  function createMYSQL($tableSchema, $table)
  {
    $schemaBuilder = new SchemaBuilder();
    $query = $schemaBuilder->createTable($table, $tableSchema);

    $file = "migrations/" . $table . '.sql';
    file_put_contents($file, $query);

    $json = json_encode($tableSchema, JSON_PRETTY_PRINT);
    $file = "migrations/json/" . $table . '.json';
    file_put_contents($file, $json);
  }

  function executeMYSQL($table){
    try {
        // Set the database connection string
        $dsn = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
        // Create a new PDO object and set the encoding to utf8
        $pdo = new PDO($dsn,DB_USER,DB_PASS);
        $pdo->exec("set names utf8");
        // Set the error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Read the SQL query from the migrations folder
        $query = file_get_contents('migrations/'.$table.'.sql');
        // Execute the SQL query
        $pdo->exec($query);
        // Print a success message
        echo 'SQL file successfully installed';
    } catch (PDOException $e) {
        // Print an error message if an exception occurs
        echo "Installation failed: " . $e->getMessage();
    }
}


  function createRouter($table){
    $createRoutes = generateRoutes($table);
    file_put_contents('routers.php', "\n" . implode("\n", $createRoutes) . "\n", FILE_APPEND | LOCK_EX);  
    echo "Router Created!";
  }

  function createResource($table){
    $createRoutes = generateResource($table);
    $routerContents = file_get_contents('../app/routes/web.php');

    foreach ($createRoutes as $route) {
        if (strpos($routerContents, $route) === false) {
            // the route does not already exist in the file, so add it
            file_put_contents('../app/routes/web.php', "\n" . $route . "\n", FILE_APPEND | LOCK_EX);
        }
    }

    echo "Router Created!";
}




  function createModelController($table,$getColumns,$getRules){
    createModel($table,$getColumns);
    createController($table,$getRules,$getColumns);
    echo "Model Controller Created!";
  }

  function createMyView($table,$tableSchema,$searchColumns){
    createView($table,$tableSchema,$searchColumns);
    echo "Views Created!";
  }

  createMYSQL($tableSchema, $table);
  createRouter($table);
  createResource($table);
  createModelController($table,$getColumns,$getRules);
  createMyView($table,$tableSchema,$searchColumns);
  executeMYSQL($table);


}