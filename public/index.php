<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include Composer's autoload file
require_once '../vendor/autoload.php';

include "../app/init.php";
date_default_timezone_set('UTC');

// Create the application instance
$app = new App(dirname(__DIR__));
// Set a session variable
// App::$session->set('user_name', 'John Doe');

// Register global middleware
$app->use(CSRF::class);

// Load routes
require_once '../app/routes/web.php';
require_once '../app/routes/api.php';

// Run the application
$app->run();
