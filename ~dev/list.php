<?php

$_ENV = parse_ini_file('./../app/.env', false, INI_SCANNER_RAW);
define("APP_NAME",$_ENV["APP_NAME"]);
define("THEME",$_ENV["THEME"]);
define('DB_TYPE',$_ENV["DB_CONNECTION"]);
define('DB_HOST',$_ENV["DB_HOST"]);
define('DB_NAME',$_ENV["DB_DATABASE"]);
define('DB_USER',$_ENV["DB_USERNAME"]);
define('DB_PASS',$_ENV["DB_PASSWORD"]);
function listFiles($dir) {
    // Get all files and directories in the given directory
    $files = scandir($dir);
    echo "<table>
            <thead>
            <tr>
                <th>Model</th>
                <th>Code</th>
                <th>Destroy</th>
                <th>Modify</th>
            </tr>
            </thead>
            <tbody>";
    // Loop through each file/directory
    foreach ($files as $file) {
        // Skip . and .. directories
        if ($file === '.' || $file === '..') {
            continue;
        }

        // Get the full path of the file/directory
        $path = $dir . '/' . $file;

        // If the file/directory is a directory, recursively call this function on it
        if (is_dir($path)) {
            listFiles($path);
        } else { 
            // If the file/directory is a file, print its name with a line break

            ?>
            <tr>
            <td><?php echo $file . "\n"."<br>";?></td>
            <td><?php printCode("./migrations/json/{$file}",$file); ?></td>
            <td><button onclick="location.href='list.php?delete=<?php echo str_replace('.json', '', $file); ?>'">Destroy</button></td>
            <td><button class="modify" data-target="json-code-<?=str_replace('.json', '', $file)?>">Modify</button></td>
          </tr>
      <?php  }
    }
    echo "</tbody>
    </table>";
}

function printCode($filename,$file) {
    // Read the contents of the file into a string
    $code = file_get_contents($filename);

    // Print the code with syntax highlighting
    echo '<pre><code id="json-code-' . str_replace('.json', '', $file) . '">' . htmlspecialchars($code) . '</code></pre>';

}

function deleteFiles($name) {
    $controllerFile = './../app/controllers/' . $name . 'Controller.php';
    $modelFile = './../app/models/' . $name . 'Model.php';
    $viewsDir = "../app/views/".THEME."/$name";

    $jsonFile = './migrations/json/' . $name. '.json';
        // Delete the model file
        if (file_exists($jsonFile)) {
            unlink($jsonFile);
        }

    // Delete the controller file
    if (file_exists($controllerFile)) {
        unlink($controllerFile);
    }

    // Delete the model file
    if (file_exists($modelFile)) {
        unlink($modelFile);
    }

    // Delete the views directory and all its contents
    if (is_dir($viewsDir)) {
        $files = scandir($viewsDir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $viewsDir . '/' . $file;
            if (is_dir($path)) {
                // If the file is a directory, recursively call this function on it
                deleteFiles($path);
            } else {
                // If the file is a file, delete it
                unlink($path);
            }
        }
        // Delete the views directory itself
        rmdir($viewsDir);
    }
}
function destroyTable($tableName) {
    // Connect to MySQL using PDO
    $dsn = DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    // Check if table exists
    $stmt = $pdo->prepare("SHOW TABLES LIKE :tableName");
    $stmt->execute(['tableName' => $tableName]);
    $result = $stmt->fetch();
    if (!$result) {
        echo "Table $tableName does not exist.";
        return;
    }
    // Drop the table
    $sql = "DROP TABLE `$tableName`";
    $pdo->exec($sql);
    echo "Table $tableName dropped successfully.";
    // Close the PDO connection
    $pdo = null;
}


listFiles('./migrations/json');

if(isset($_GET['delete'])){
  destroyTable($_GET['delete']);
  deleteFiles($_GET['delete']);
  echo "Controller,Model,Views, MySQL table of ".$_GET['delete']." has been deleted";
    header("refresh:3;url=index.php");
    echo "You will be redirected to the homepage in 3 seconds...";
    sleep(3); // This will pause the script for 3 seconds
    exit; // This will stop the script from executing further


}



?>