<?php
function p($value){
   echo "<pre>";
   var_dump($value);
   echo "</pre>";
   exit;
}
function d($value){
   echo "<pre>";
   var_dump($value);
   echo "</pre>";

}

function redirect($path, $statusCode = 303) {
   $url = ROOT.'/'.$path;
   header('Location: ' . $url, true, $statusCode);
   die();
}

function generateUniqueId($length = 16) {
   $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $result = '';
   for ($i = 0; $i < $length; $i++) {
       $result .= $chars[random_int(0, strlen($chars) - 1)];
   }
   return $result;
}

function generateCSRFToken() {
   $token = bin2hex(random_bytes(32));
   $_SESSION['_token'] = $token;
   return $token;
 }

 function validateCSRFToken($token) {
   if (isset($_SESSION['_token']) && hash_equals($_SESSION['_token'], $token)) {
     unset($_SESSION['_token']);
     return true;
   }
   return false;
 }

 function csrf() {
   $token = generateCSRFToken();
   return '<input type="hidden" name="_token" value="' . $token . '">';
 }

 function removeTokenElement($data) {
   if (isset($data['_token'])) {
       unset($data['_token']);
   }
   return $data;
}

function formatTime($formatTime) {
   $postTime = strtotime($formatTime);
   $currentTime = time();
   $timeDiff = $currentTime - $postTime;
 
   if ($timeDiff < 60) {
     // Less than 1 minute
     return $timeDiff . 's';
   } elseif ($timeDiff < 3600) {
     // Less than 1 hour
     $minutes = floor($timeDiff / 60);
     return $minutes . 'm';
   } elseif ($timeDiff < 86400) {
     // Less than 24 hours
     $hours = floor($timeDiff / 3600);
     return $hours . 'h';
   } else {
     // More than 24 hours, display the full date and time
     //return date('d F Y \. h:i A', $postTime);
     //return date('d M Y \. h:i A', $postTime);
     return date('d M y \. h:i A', $postTime);


   }
 }
 
 function formatTimeShort($formatTime) {
  $postTime = strtotime($formatTime);
  $currentTime = time();
  $timeDiff = $currentTime - $postTime;

  if ($timeDiff < 60) {
    // Less than 1 minute
    return $timeDiff . 's';
  } elseif ($timeDiff < 3600) {
    // Less than 1 hour
    $minutes = floor($timeDiff / 60);
    return $minutes . 'm';
  } elseif ($timeDiff < 86400) {
    // Less than 24 hours
    $hours = floor($timeDiff / 3600);
    return $hours . 'h';
  } else {
    // More than 24 hours, display the full date and time
    //return date('d F Y \. h:i A', $postTime);
    //return date('d M Y \. h:i A', $postTime);
    return date('d M y', $postTime);


  }
}
 
 
 function calculateDaysToFutureDate($futureDate) {
   $today = new DateTime();
   $future = new DateTime($futureDate);
   $interval = $today->diff($future);
   return $interval->days;
}

function AutoLink($text) {
  // Regular expression to match URLs
  $pattern = '/https?:\/\/\S+/';

  // Find all matches of the pattern in the text
  preg_match_all($pattern, $text, $matches);

  // Loop through the matches and replace each URL with an anchor tag
  foreach ($matches[0] as $url) {
      $linkText = $url; // You can customize the link text if needed
      $replacement = "<span class='auto-link-container'><a class='auto-link' href='$url' target='_blank'>$linkText</a></span>";
      $text = str_replace($url, $replacement, $text);
  }

  return $text;
}


function convertToClickableHashtags($userInput) {
  // Extract hashtags using regular expression
  preg_match_all('/#\w+/', $userInput, $matches);

  if (!empty($matches[0])) {
      foreach ($matches[0] as $hashtag) {
          $hashtagWithoutHash = substr($hashtag, 1);
          $userInput = str_replace($hashtag, '<a class="hashtag-link" href="'.ROOT.'/hashtag/'.$hashtagWithoutHash.'">'.$hashtag.'</a>', $userInput);
      }
  }

  return $userInput;
}

function isLinkActive($linkPath) {
  $currentPath = $_SERVER['REQUEST_URI'];

  // Check if the linkPath is empty (homepage) or is part of the current URL
  if ((empty($linkPath) && $currentPath === '/') || (empty($linkPath) && $currentPath === '')) {
      return 'active';
  } elseif (!empty($linkPath) && strpos($currentPath, $linkPath) !== false) {
      return 'active';
  }

  return '';
}


function getBaseUrl() {
  // Determine the current scheme (http or https)
  $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

  // Determine the server port
  $port = $_SERVER['SERVER_PORT'];

  // Construct the base URL using the scheme, server name, and port
  $baseUrl = $scheme . '://' . $_SERVER['SERVER_NAME'];
  if (($scheme === 'http' && $port != 80) || ($scheme === 'https' && $port != 443)) {
      $baseUrl .= ':' . $port;
  }

  // Determine the base path (script name without "index.php")
  $basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

  // Combine the base URL and base path to get the full base URL
  $fullBaseUrl = $baseUrl . $basePath;

  return $fullBaseUrl;
}

function uploadFile(
  string $inputName,
  string $uploadDir = '../public/assets/alpha-theme/img/uploads/',
  array $allowedExtensions = [],
  int $maxSize = 52428800,
  bool $generateThumbnail = false
): string|false {
  if (!isset($_FILES[$inputName]) || $_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) return false;

  $file = $_FILES[$inputName];
  $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
  $tmp = $file['tmp_name'];
  $size = $file['size'];

  $mimeMap = [ // supported MIME types
      'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png',
      'gif' => 'image/gif', 'webp' => 'image/webp', 'bmp' => 'image/bmp', 'svg' => 'image/svg+xml',
      'pdf' => 'application/pdf', 'doc' => 'application/msword',
      'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
      'xls' => 'application/vnd.ms-excel', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      'ppt' => 'application/vnd.ms-powerpoint', 'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
      'txt' => 'text/plain', 'csv' => 'text/csv', 'rtf' => 'application/rtf',
      'mp3' => 'audio/mpeg', 'wav' => 'audio/wav', 'ogg' => 'audio/ogg', 'm4a' => 'audio/mp4', 'aac' => 'audio/aac',
      'mp4' => 'video/mp4', 'avi' => 'video/x-msvideo', 'mov' => 'video/quicktime', 'webm' => 'video/webm', 'mkv' => 'video/x-matroska',
      'zip' => 'application/zip', 'rar' => 'application/x-rar-compressed', 'tar' => 'application/x-tar',
      'gz' => 'application/gzip', '7z' => 'application/x-7z-compressed',
  ];

  if (!in_array($ext, $allowedExtensions) || !isset($mimeMap[$ext])) return false;

  $finfo = new finfo(FILEINFO_MIME_TYPE);
  if ($finfo->file($tmp) !== $mimeMap[$ext] || $size > $maxSize) return false;

  $uploadDir = rtrim($uploadDir, '/') . '/';
  if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

  $filename = bin2hex(random_bytes(12)) . '.' . $ext;
  $filepath = $uploadDir . $filename;

  if (!move_uploaded_file($tmp, $filepath)) return false;

  // Optional thumbnail generation
  if ($generateThumbnail && in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
      $thumbDir = $uploadDir . 'thumbnails/';
      if (!is_dir($thumbDir)) mkdir($thumbDir, 0755, true);
      createThumbnail($filepath, $thumbDir . $filename, 300);
  }

  return $filename;
}


function createThumbnail(string $src, string $dest, int $width): bool {
  $ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
  switch ($ext) {
      case 'jpg':
      case 'jpeg': $img = imagecreatefromjpeg($src); break;
      case 'png':  $img = imagecreatefrompng($src); break;
      case 'gif':  $img = imagecreatefromgif($src); break;
      case 'webp': $img = imagecreatefromwebp($src); break;
      default: return false;
  }

  [$w, $h] = [imagesx($img), imagesy($img)];
  $height = intval($h * $width / $w);
  $thumb = imagecreatetruecolor($width, $height);
  imagecopyresampled($thumb, $img, 0, 0, 0, 0, $width, $height, $w, $h);

  switch ($ext) {
      case 'jpg':
      case 'jpeg': imagejpeg($thumb, $dest); break;
      case 'png':  imagepng($thumb, $dest); break;
      case 'gif':  imagegif($thumb, $dest); break;
      case 'webp': imagewebp($thumb, $dest); break;
  }

  imagedestroy($img);
  imagedestroy($thumb);
  return true;
}


function renderPagination(array $pagination) {
    if (empty($pagination['total']) || $pagination['total'] <= 0 || $pagination['totalPages'] <= 1) {
        return; // No pagination needed
    }

    $currentPage = (int) ($pagination['currentPage'] ?? 1);
    $totalPages = (int) ($pagination['totalPages'] ?? 1);

    // Function to build URL with existing query parameters except 'page'
    function buildPageUrl($page) {
        $query = $_GET;
        $query['page'] = $page;
        return '?' . http_build_query($query);
    }
    ?>

    <nav class="pagination">
        <ul>
            <!-- Previous Button -->
            <?php if ($currentPage > 1): ?>
                <li><a href="<?php echo buildPageUrl($currentPage - 1); ?>">&laquo; Prev</a></li>
            <?php else: ?>
                <li class="disabled"><span>&laquo; Prev</span></li>
            <?php endif; ?>

            <!-- First Page -->
            <?php if ($currentPage > 3): ?>
                <li><a href="<?php echo buildPageUrl(1); ?>">1</a></li>
                <?php if ($currentPage > 4): ?>
                    <li><span>...</span></li>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Middle Pages -->
            <?php
            $start = max(1, $currentPage - 1);
            $end = min($totalPages, $currentPage + 1);

            for ($i = $start; $i <= $end; $i++):
                if ($i == $currentPage):
            ?>
                <li class="active"><span><?php echo $i; ?></span></li>
            <?php else: ?>
                <li><a href="<?php echo buildPageUrl($i); ?>"><?php echo $i; ?></a></li>
            <?php
                endif;
            endfor;
            ?>

            <!-- Last Page -->
            <?php if ($currentPage < $totalPages - 2): ?>
                <?php if ($currentPage < $totalPages - 3): ?>
                    <li><span>...</span></li>
                <?php endif; ?>
                <li><a href="<?php echo buildPageUrl($totalPages); ?>"><?php echo $totalPages; ?></a></li>
            <?php endif; ?>

            <!-- Next Button -->
            <?php if ($currentPage < $totalPages): ?>
                <li><a href="<?php echo buildPageUrl($currentPage + 1); ?>">Next &raquo;</a></li>
            <?php else: ?>
                <li class="disabled"><span>Next &raquo;</span></li>
            <?php endif; ?>
        </ul>

        <!-- Go to Page Form -->
        <form method="get" class="goto-form" onsubmit="return gotoPage(this, <?php echo $totalPages; ?>);">
            <!-- Keep existing GET parameters except 'page' -->
            <?php
            foreach ($_GET as $key => $value) {
                if ($key !== 'page') {
                    echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                }
            }
            ?>
            <input type="number" name="page" min="1" max="<?php echo $totalPages; ?>" placeholder="Page" required>
            <button type="submit">Go</button>
        </form>
    </nav>

    
    <script>
    function gotoPage(form, totalPages) {
        var page = parseInt(form.page.value);
        if (page >= 1 && page <= totalPages) {
            form.submit();
        } else {
            alert('Please enter a valid page number between 1 and ' + totalPages);
        }
        return false;
    }
    </script>

    <?php
}
