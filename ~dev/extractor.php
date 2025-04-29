<?php
function extractAndMoveFiles($zipFilePath, $destinationDir) {
    $zip = new ZipArchive;

    // Open the zip file
    if ($zip->open($zipFilePath) === TRUE) {
        // Create the destination directories if they don't exist
        $modelDir = $destinationDir . '/models';
        $viewDir = $destinationDir . '/views';
        $controllerDir = $destinationDir . '/controllers';

        if (!is_dir($modelDir)) mkdir($modelDir, 0755, true);
        if (!is_dir($viewDir)) mkdir($viewDir, 0755, true);
        if (!is_dir($controllerDir)) mkdir($controllerDir, 0755, true);

        // Iterate over each file in the zip
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $file = $zip->getNameIndex($i);
            
            // Get the basename of the file
            $fileName = basename($file);
            
            // Move files based on their directory and naming convention
            if (preg_match('/Model\.php$/', $fileName)) {
                // Move files with 'Model.php' to the models directory
                $zip->extractTo($modelDir, $file);
            } elseif (strpos($file, 'views/') !== false) {
                // Move view files into views directory
                $zip->extractTo($viewDir, $file);
            } elseif (preg_match('/Controller\.php$/', $fileName)) {
                // Move files with 'Controller.php' to the controllers directory
                $zip->extractTo($controllerDir, $file);
            }
        }
        $zip->close();
        echo "Files moved successfully!";
    } else {
        echo "Failed to open the zip file.";
    }
}

// Usage
$zipFilePath = 'files.zip'; // Replace with your zip file path
$destinationDir = 'foo'; // Replace with your desired destination
extractAndMoveFiles($zipFilePath, $destinationDir);
?>
