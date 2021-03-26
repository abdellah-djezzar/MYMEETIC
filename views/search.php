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
    <h2>Good research</h2>
    <div class="container">
        <form id="search-form" action="./views/search.php" method="get">
            <div class="row">
                <div class="col-md-12">
                    <h3>Rechercher parmis les membres :</h3>
                </div>
                <div class="col-md-3">
                    <select name="sexe" class="form-control">
                        <option value="" class="options_sexe">Genre</option>
                        <option value="H" class="options_sexe"
                            <?php
                            if (isset($_GET['sexe'])) {
                                if ($_GET['sexe'] === "H") {
                                    echo " selected='selected'";
                                }
                            }
                            ?>
                        >Homme</option>
                        <option value="F" class="options_genre"<?php
                        if (isset($_GET['sexe'])) {
                            if ($_GET['sexe'] === "F") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Femme</option>
                        <option value="A" class="options_genre"<?php
                        if (isset($_GET['sexe'])) {
                            if ($_GET['sexe'] === "A") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Autres</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="birthdate" class="form-control">
                        <option value="" class="options_age">Age</option>
                        <option value="25-" class="options_age"
                            <?php
                            if (isset($_GET['birthdate'])) {
                                if ($_GET['birthdate'] === "25-") {
                                    echo " selected='selected'";
                                }
                            }
                            ?>
                        >18-25</option>
                        <option value="35-" class="options_age"<?php
                        if (isset($_GET['birthdate'])) {
                            if ($_GET['birthdate'] === "35-") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >25-35</option>
                        <option value="45-" class="options_age"<?php
                        if (isset($_GET['birthdate'])) {
                            if ($_GET['birthdate'] === "45-") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >35-45</option>
                        <option value="45+" class="options_age"<?php
                        if (isset($_GET['birthdate'])) {
                            if ($_GET['birthdate'] === "45+") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >45+</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="city" class="form-control">
                        <option value="" class="options_limit">Ville</option>
                        <option value="Paris" class="options_limit"
                            <?php
                            if (isset($_GET['city'])) {
                                if ($_GET['city'] === "Paris") {
                                    echo " selected='selected'";
                                }
                            }
                            ?>
                        >Paris</option>
                        <option value="Lyon" class="options_limit"<?php
                        if (isset($_GET['city'])) {
                            if ($_GET['city'] === "Lyon") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Lyon</option>
                        <option value="Marseille" class="options_limit"<?php
                        if (isset($_GET['city'])) {
                            if ($_GET['city'] === "Marseille") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Marseille</option>
                    </select>
                    <input id="add-city" type="button" class="btn btn-warning"
                           value="Rajouter une ville à la sélection">
                    <input id="hide-city" type="button" class="btn btn-warning"
                           value="Enlever cet option.">
                    <select id="city2" name="city2" class="form-control">
                        <option value="" class="options_limit">Ville</option>
                        <option value="Paris" class="options_limit"
                            <?php
                            if (isset($_GET['city2'])) {
                                if ($_GET['city2'] === "Paris") {
                                    echo " selected='selected'";
                                }
                            }
                            ?>
                        >Paris</option>
                        <option value="Lyon" class="options_limit"<?php
                        if (isset($_GET['city2'])) {
                            if ($_GET['city2'] === "Lyon") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Lyon</option>
                        <option value="Marseille" class="options_limit"<?php
                        if (isset($_GET['city2'])) {
                            if ($_GET['city2'] === "Marseille") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Marseille</option>
                    </select>
                    <select id="city3" name="city3" class="form-control">
                        <option value="" class="options_limit">Ville</option>
                        <option value="Paris" class="options_limit"
                            <?php
                            if (isset($_GET['city3'])) {
                                if ($_GET['city3'] === "Paris") {
                                    echo " selected='selected'";
                                }
                            }
                            ?>
                        >Paris</option>
                        <option value="Lyon" class="options_limit"<?php
                        if (isset($_GET['city3'])) {
                            if ($_GET['city3'] === "Lyon") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Lyon</option>
                        <option value="Marseille" class="options_limit"<?php
                        if (isset($_GET['city3'])) {
                            if ($_GET['city3'] === "Marseille") {
                                echo " selected='selected'";
                            }
                        }
                        ?>
                        >Marseille</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-warning">Rechercher</button>
                </div>
            </div>
        </form>
    </div>
        <?php
            include_once "../controller/search.php";
        ?>
<section>
    <?php
    include_once "footer.html";
    ?>
</section>
<script src="webroot/js/jquery-3.3.1.min.js"></script>
<script src="webroot/js/myDropdown.js"></script>
<script src="webroot/js/myCarousel.js"></script>
<script src="webroot/js/search.js"></script>
</body>
</html>
