<?php


// App Root
define('APP_ROOT', dirname(__DIR__));

// Load Database Connection
require_once '../database/connection.php';

// Load Helpers
require_once '../app/helpers/helper.php';

// Load Routes
require_once '../routes/web.php';
