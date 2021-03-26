<?php

define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('DS', DIRECTORY_SEPARATOR);
define('VIEWS', BASE_URL.DS. 'views');

if (isset($_POST)) {
    if (!empty($_POST['logout'])) {
        if ($_POST['logout'] === 'Déconnexion') {
            session_unset();
            header("Location: " . VIEWS . DS . "index.php");
        }
    }
}
