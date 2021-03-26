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
require_once CONTROLLER . DS . 'Profile.php';
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
    include_once CONTROLLER . DS . "deleteProfile.php";
    ?>
</section>
<section>
    <div class="container">
    <h2>Zone à risque, supprimer votre compte ne vous permet pas de vous reconnecter plus tard</h2>
      <form method="post" action="index.php">
          <input type="submit" id="btn_delete" class="btn btn-error" name="deleteAccount" value="yes">
      </form>
    </div>
</section>
<section>
    <?php
    include_once "footer.html";
    ?>
</section>
<script src="webroot/js/jquery-3.3.1.min.js"></script>
<script src="webroot/js/myDropdown.js"></script>
<script src="webroot/js/profile.js"></script>
</body>
</html>
