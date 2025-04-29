<?php

function generateForm($tableSchema, $filename){
  $html = '<form method="post">';
  foreach ($tableSchema as $columnName => $columnType) {
      $inputType = '';
      if (strpos($columnType, 'integer') !== false) {
          $inputType = 'number';
      } elseif (strpos($columnType, 'string') !== false) {
          $inputType = 'text';
      } elseif (strpos($columnType, 'text') !== false) {
          $inputType = 'textarea';
      } elseif (strpos($columnType, 'timestamp') !== false) {
          $inputType = 'datetime-local';
      }

      $html .= '<label for="'.$columnName.'">'.$columnName.'</label>';
      if ($inputType == 'textarea') {
          $html .= '<textarea name="'.$columnName.'"></textarea>';
      } else {
          $html .= '<input type="'.$inputType.'" name="'.$columnName.'"></br>';
      }
  }

  $html .= '<input type="submit" value="Submit">';
  $html .= '</form>';

  // Save HTML string as PHP file
  $filename = $filename . '.php'; // Add file extension
  file_put_contents($filename, '<?php ' . PHP_EOL . 'echo \'' . addslashes($html) . '\';' . PHP_EOL);

  return $html;
}

