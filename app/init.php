
<?php
$_ENV = parse_ini_file('config/.env', false, INI_SCANNER_RAW);
// Define constants
define("APP_NAME", $_ENV["APP_NAME"]);
define("THEME", $_ENV["THEME"]);
define('ROOT', $_ENV["APP_PATH"]);
define('ASSETS', ROOT . "/assets/" . THEME);
define('DB_TYPE', $_ENV["DB_CONNECTION"]);
define('DB_HOST', $_ENV["DB_HOST"]);
define('DB_NAME', $_ENV["DB_DATABASE"]);
define('DB_USER', $_ENV["DB_USERNAME"]);
define('DB_PASS', $_ENV["DB_PASSWORD"]);


// Load email configurations
define('MAIL_HOST', $_ENV['MAIL_HOST']);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
define('MAIL_PORT', $_ENV['MAIL_PORT']);
define('MAIL_ENCRYPTION', $_ENV['MAIL_ENCRYPTION']);
define('MAIL_FROM_ADDRESS', $_ENV['MAIL_FROM_ADDRESS']);
define('MAIL_FROM_NAME', $_ENV['MAIL_FROM_NAME']);


// Include core files
// include_once "../app/core/Function.php";
// include_once "../app/core/App.php";
// include_once "../app/core/Controller.php";
// include_once "../app/core/Request.php";
// include_once "../app/core/Response.php";
// include_once "../app/core/MiddlewareInterface.php";
// include_once "../app/core/Router.php";
// include_once "../app/core/Database.php";
// include_once "../app/core/Model.php";
// include_once "../app/core/Validator.php";
// include_once "../app/core/Pagination.php";
// include_once "../app/core/Language.php";
// include_once "../app/core/View.php";
