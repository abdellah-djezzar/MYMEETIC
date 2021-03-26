<?php

session_start();

define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT.DS. 'controller');
define('VIEWS', BASE_URL.DS. 'views');

if (!isset($_SESSION['id'])) {
    header("Location: " . VIEWS . DS . "index.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Meestycall</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?php echo BASE_URL . DS ?>">
    <link rel="stylesheet" href="webroot/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="webroot/css/bootstrap.min.css">
    <link rel="stylesheet" href="webroot/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="webroot/sass/main.css">

</head>
<body>
<section class="header">
    <?php
    include_once CONTROLLER . DS . "logout.php";
    include_once "header.html";
    ?>
</section>
<section class="red-bloc">
    <div class="container">
        <h2>Welcome to you !</h2>
    </div>
    <div class="container-fluid">
        Présentation de MeestyCall
    </div>
    <div class="container">
        <p> Demander quel type recherchez vous ? H F A </p>
    </div>
    <section class="section_img_register">
        <div class="container-fluid">
            <div class="container">
                <div class="center_img">
                    <img class="mouse_heart img-thumbnail" src="webroot/images/header_coeur.jpeg" alt="image_heart_mouse">
                </div>
            </div>
        </div>
        <div class="container">
            <img class="img-thumbnail images-inscription" src="webroot/images/dating.jpeg" alt="image_heart_dating">
            <img class="img-thumbnail images-inscription" src="webroot/images/hand_coeur.jpeg"
                 id="image_hand_heart" alt="image_hand_in_heart">
            <img class="img-thumbnail images-inscription" src="webroot/images/dating.jpeg" alt="image_heart_dating">
        </div>
        <div class="container">
            Présentation rapide de MeestyCall
        </div>

    </section>
</section>
<section>
    <?php
    include_once "footer.html";
    ?>
</section>
<script src="webroot/js/jquery-3.3.1.min.js"></script>
<script src="webroot/js/myDropdown.js"></script>
<script src="webroot/js/members.js"></script>
</body>
</html>
