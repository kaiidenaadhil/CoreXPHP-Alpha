<?php
$_ENV = parse_ini_file('./../app/config/.env', false, INI_SCANNER_RAW);
define("APP_NAME",$_ENV["APP_NAME"]);
define("THEME",$_ENV["THEME"]);
define('DB_TYPE',$_ENV["DB_CONNECTION"]);
define('DB_HOST',$_ENV["DB_HOST"]);
define('DB_NAME',$_ENV["DB_DATABASE"]);
define('DB_USER',$_ENV["DB_USERNAME"]);
define('DB_PASS',$_ENV["DB_PASSWORD"]);

function createView($dirname,$tableSchema,$searchColumns){
    // create the directory if it doesn't exist
    if (!file_exists("../app/views/".THEME."/$dirname")) {
        mkdir("../app/views/".THEME."/$dirname", 0777, true);
    }else
    {
        echo "File exist";
    }

    // New View
    $file1 = fopen("../app/views/".THEME."/$dirname/$dirname"."New.php", 'w');
    $codeNew = generateForm($tableSchema, $dirname);
    fwrite($file1,$codeNew);
    fclose($file1);

    // All View
    $file2 = fopen("../app/views/".THEME."/$dirname/$dirname"."All.php", 'w');
    $codeAll = generateTableAll($searchColumns, $dirname);
    fwrite($file2,$codeAll);
    fclose($file2);

    // Single View

    $file3 = fopen("../app/views/".THEME."/$dirname/$dirname"."Single.php", 'w');
    $codeSingle = generateTable($searchColumns, $dirname);
    fwrite($file3, $codeSingle);
    fclose($file3);

    //Edit View

    $file4 = fopen("../app/views/".THEME."/$dirname/$dirname"."Edit.php", 'w');
    $codeEdit = generateEditForm($tableSchema, $dirname);
    fwrite($file4, $codeEdit);
    fclose($file4);

    echo "Files created  in views/ '$dirname'.";
}


function generateEditForm($tableSchema, $model) {
    $table = singularize($model);
    $fieldsToRemove = [$table . 'CreatedAt', $table . 'UpdatedAt', $table . 'Identify'];
    $tableSchema = removeFields($tableSchema, $fieldsToRemove);
    array_shift($tableSchema);

    $html = '  <div class="data-table">' . "\n";
    $html .= '    <div class="table-container">' . "\n";
    $html .= '      <h2>Edit ' . $model . '</h2>' . "\n";
    $html .= '      <?php foreach ($params["' . $model . '"] as $key => $' . $model . ') : ?>' . "\n";
    $html .= '      <form method="post" enctype="multipart/form-data" action="<?= ROOT ?>/admin/' . $model . '/<?= $' . $model . '[\'' . singularize($model) . 'Identify\'] ?>/modify">' . "\n";

    foreach ($tableSchema as $columnName => $columnType) {
        $label = camelCaseToSentence($columnName);
        $isNullable = strpos($columnType, 'nullable') !== false;

        $html .= '        <div>' . "\n";
        $html .= '          <label for="' . $columnName . '">' . $label . '</label>' . "\n";

        if (strpos($columnType, 'enum:') !== false) {
            preg_match('/enum:([a-zA-Z0-9_,\- ]+)/', $columnType, $matches);
            $enumValues = isset($matches[1]) ? explode(',', $matches[1]) : [];
            $html .= '          <select name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '>' . "\n";
            foreach ($enumValues as $option) {
                $html .= '            <option value="' . $option . '" <?= $' . $model . '["' . $columnName . '"] == "' . $option . '" ? "selected" : "" ?>>' . ucfirst($option) . '</option>' . "\n";
            }
            $html .= '          </select>' . "\n";
        } elseif (preg_match('/tinyint\(1\)|boolean/i', $columnType)) {
            $html .= '          <input type="checkbox" name="' . $columnName . '" value="1" <?= $' . $model . '["' . $columnName . '"] ? "checked" : "" ?>>' . "\n";
        } elseif (preg_match('/text|longtext/i', $columnType)) {
            $html .= '          <textarea name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '><?= $' . $model . '["' . $columnName . '"] ?></textarea>' . "\n";
        } elseif (strpos($columnType, 'file') !== false || stripos($columnName, 'file') !== false || stripos($columnName, 'image') !== false) {
            $html .= '          <input type="file" name="' . $columnName . '">' . "\n";
        } elseif (preg_match('/float|double|decimal/i', $columnType)) {
            $html .= '          <input type="number" step="0.01" name="' . $columnName . '" value="<?= $' . $model . '["' . $columnName . '"] ?>" ' . ($isNullable ? '' : 'required') . '>' . "\n";
        } elseif (preg_match('/int|integer/i', $columnType)) {
            $html .= '          <input type="number" name="' . $columnName . '" value="<?= $' . $model . '["' . $columnName . '"] ?>" ' . ($isNullable ? '' : 'required') . '>' . "\n";
        } else {
            $html .= '          <input type="text" name="' . $columnName . '" value="<?= $' . $model . '["' . $columnName . '"] ?>" ' . ($isNullable ? '' : 'required') . '>' . "\n";
        }

        $html .= '        </div>' . "\n";
    }

    $html .= '        <div><aside class="row">' . "\n";
    $html .= '          <input type="submit" value="Update" class="save-btn">' . "\n";
    $html .= '          <a href="<?= ROOT ?>/admin/' . $model . '" class="cancel-btn">Back</a>' . "\n";
    $html .= '        </aside></div>' . "\n";
    $html .= '      </form>' . "\n";
    $html .= '      <?php endforeach; ?>' . "\n";
    $html .= '    </div>' . "\n";
    $html .= '  </div>' . "\n";

    return $html;
}




function generateForm($tableSchema, $model) {
    $table = singularize($model);
    $fieldsToRemove = [$table . 'CreatedAt', $table . 'UpdatedAt', $table . 'Identify'];
    $tableSchema = removeFields($tableSchema, $fieldsToRemove);
    array_shift($tableSchema);

    $html = '  <div class="data-table">' . "\n";
    $html .= '    <div class="table-container">' . "\n";
    $html .= '      <h2>Create ' . $model . '</h2>' . "\n";
    $html .= '      <form method="post" enctype="multipart/form-data" action="<?= ROOT ?>/admin/' . $model . '/build">' . "\n";

    foreach ($tableSchema as $columnName => $columnType) {
        $label = camelCaseToSentence($columnName);
        $isNullable = strpos($columnType, 'nullable') !== false;

        $html .= '        <div>' . "\n";
        $html .= '          <label for="' . $columnName . '">' . $label . '</label>' . "\n";

        if (strpos($columnType, 'enum:') !== false) {
            preg_match('/enum:([a-zA-Z0-9_,\- ]+)/', $columnType, $matches);
            $enumValues = isset($matches[1]) ? explode(',', $matches[1]) : [];
            $html .= '          <select name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '>' . "\n";
            foreach ($enumValues as $option) {
                $html .= '            <option value="' . $option . '">' . ucfirst($option) . '</option>' . "\n";
            }
            $html .= '          </select>' . "\n";
        } elseif (preg_match('/tinyint\(1\)|boolean/i', $columnType)) {
            $html .= '          <input type="checkbox" name="' . $columnName . '" value="1">' . "\n";
        } elseif (preg_match('/text|longtext/i', $columnType)) {
            $html .= '          <textarea name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '></textarea>' . "\n";
        } elseif (strpos($columnType, 'file') !== false || stripos($columnName, 'file') !== false || stripos($columnName, 'image') !== false) {
            $html .= '          <input type="file" name="' . $columnName . '">' . "\n";
        } elseif (preg_match('/float|double|decimal/i', $columnType)) {
            $html .= '          <input type="number" step="0.01" name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '>' . "\n";
        } elseif (preg_match('/int|integer/i', $columnType)) {
            $html .= '          <input type="number" name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '>' . "\n";
        } else {
            $html .= '          <input type="text" name="' . $columnName . '" ' . ($isNullable ? '' : 'required') . '>' . "\n";
        }

        $html .= '        </div>' . "\n";
    }

    $html .= '        <div><aside class="row">' . "\n";
    $html .= '          <input type="submit" value="Create" class="save-btn">' . "\n";
    $html .= '          <a href="<?= ROOT ?>/admin/' . $model . '" class="cancel-btn">Back</a>' . "\n";
    $html .= '        </aside></div>' . "\n";
    $html .= '      </form>' . "\n";
    $html .= '    </div>' . "\n";
    $html .= '  </div>' . "\n";

    return $html;
}



  function generateTableAll($searchColumns, $model) {
    $searchColumns = removeThree($searchColumns);

    //search button
    $table = '<div class="search-container">'."\n";
    $table .= '<form class="search-form" action="<?= ROOT ?>/admin/'.$model.'/" method="get">'."\n";
    $table .= '<input type="text" name="search" placeholder="Search">'."\n";
    $table .= '<button type="submit" class="gradient-btn">Search</button>'."\n"; // Changed type to "submit"
    $table .= '</form>'."\n";
    $table .= '</div>'."\n";   


    $table .= '<div class="data-info">'."\n";
    $table .= '<?php if (isset($_SESSION[\'success_message\'])): ?>'."\n";
    $table .= '<p><?= $_SESSION[\'success_message\'] ?></p>'."\n";
    $table .= '<?php unset($_SESSION[\'success_message\']); ?>'."\n";
    $table .= '<?php endif; ?>'."\n";
    $table .= '</div>'."\n";
    


    $table .= '<div class="data-info">'."\n";
    $table .= '<h3>'.camelCaseToSentence($model).' List</h3> <a href="<?= ROOT ?>/admin/'.$model.'/build" class="gradient-btn">add New '.$model.'</a>'."\n";
    $table .= '</div>'."\n";

    $table .= '<div class="data-table">'."\n";
    $table .= '<div class="table-container">'."\n";
    $table .= '<?php if (count($params[\''.$model.'\']) > 0): ?>' . "\n";

    $table .= '<table>' . "\n";
    $table .= '<thead>' . "\n";
    $table .= '<tr>' . "\n";
    $table .= '<th>#</th>' . "\n";

    // Generate table header and loop code for each column
    foreach ($searchColumns as $column) {
        $table .= '<th>' . camelCaseToSentence($column) . '</th>' . "\n";
    }

    $table .= '<th>Actions</th>' . "\n";
    $table .= '</tr>' . "\n";
    $table .= '</thead>' . "\n";
    $table .= '<tbody>' . "\n";
    $table .= '<?php foreach($params[\''.$model.'\'] as $key => $'.$model.'): ?>' . "\n";
    $table .= '<tr>' . "\n";
    $table .= '<td><?= $key + 1 ?></td>' . "\n";
    $table .= generateTableLoops($searchColumns,$model);
    // action
    $table .= '<td>' . "\n";
    $table .= '<a href="<?= ROOT ?>/admin/' . $model . '/<?= $'.$model.'[\'' . singularize($model) . 'Identify\'] ?>">Show</a>' . "\n";
    $table .= '<a href="<?= ROOT ?>/admin/' . $model . '/<?= $'.$model.'[\'' . singularize($model) . 'Identify\'] ?>/modify">Edit</a>' . "\n";
    $table .= '<a href="<?= ROOT ?>/admin/' . $model . '/<?= $'.$model.'[\'' . singularize($model) . 'Identify\'] ?>/destroy">Delete</a>' . "\n";
    $table .= '</td>' . "\n";
    $table .= '</tr>' . "\n";
    $table .= '<?php endforeach; ?>' . "\n";
    $table .= '</tbody>' . "\n";
    $table .= '</table>' . "\n";
    
    // Close table body and return table
    $table .= '</div>' . "\n";
    $table .= '</div>' . "\n";

    $table .= '<div class="pagination-container">' . "\n";
    $table .= '<?= $params["pagination"] ?>' . "\n";
    $table .= '</div>' . "\n";

    $table .= '<?php else: ?>' . "\n";
    $table .= '<p>No Record to Display.</p>' . "\n";
    $table .= '<a href="<?= ROOT ?>/admin/'.$model.'/build">Add a Record.</a>' . "\n";
    $table .= '<?php endif; ?>' . "\n";
    $table .= '</div>' . "\n";

    return $table;
}



  function generateTable($searchColumns, $model) {

    $table = '  <div class="data-table">'."\n";
    $table .= '  <div class="table-container">'."\n";
    $table .= '  <h2> Display '.$model.' </h2>'."\n";
   $table .= '<table>' . "\n";
    $table .= '  <thead>' . "\n";
    $table .= '    <tr>' . "\n";
    $table .= '      <th>#</th>' . "\n";
    
    // Generate table header and loop code for each column
    foreach ($searchColumns as $column) {
      $table .= '      <th>'.camelCaseToSentence($column). '</th>' . "\n";
    }
    $table .= '    </tr>' . "\n";
    $table .= '  </thead>' . "\n";
    $table .= '  <tbody>' . "\n";
    $table .= '<?php foreach($params[\''.$model.'\'] as $key => $'.$model.'): ?>' . "\n";
    $table .= '    <tr>' . "\n";
    $table .= '      <td><?= $key + 1 ?></td>' . "\n";
    $table .= generateTableLoops($searchColumns,$model);
    $table .= '    </tr>' . "\n";
    $table .= '<?php endforeach; ?>' . "\n";
    

 
 


    $table .= '  </tbody>' . "\n";
    $table .= '</table>' . "\n";
    
    // Close table body and return table
    $table .= '</tbody>'. "\n";
    $table .= '</table>'. "\n";
    $table .=' <div><aside class="row"><a href="<?= ROOT ?>/admin/'.$model.'" class="cancel-btn">back</a></aside> </div>' . "\n";
   
    
    $table .= '</div>'."\n";
    $table .= '</div>'."\n";

    return $table;
  }
  
  function generateTableLoops($columns,$model) {

    // Initialize loop string
    $loopString = '';
    
    // Generate loop code for each column
    foreach ($columns as $column) {
      $loopString .= '<td><?= $'.$model.'[\''.$column.'\'] ?></td>' . "\n";
    }
    
    // Return loop string
    return $loopString;
  }
  
  

?>
