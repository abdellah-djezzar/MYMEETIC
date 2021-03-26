<?php

session_start();
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('DS', DIRECTORY_SEPARATOR);
define('VIEWS', BASE_URL.DS. 'views');

if (isset($_SESSION['id'])) {
    header("Location: " . VIEWS . DS . "members.php");
} else {
    header("Location: " . VIEWS . DS . "index.php");
}
