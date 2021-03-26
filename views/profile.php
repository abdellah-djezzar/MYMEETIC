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
    ?>
</section>
<section>
    <h2>Good navigate on your profil</h2>
    <div class="container-fluid">
        <div class="container center_img_cafe">
            <img class="center_img_cafe" src="webroot/images/cafe_rencontre.jpeg" alt="image_cafe_rencontre">
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="profile-container">
                <?php
                    include_once "../controller/profile.php";
                ?>
            </div>

        </div>
    </div>
    <div class="container" id="container_buttons">
        <?php
        if (isset($_GET['successRedirect']) && $_GET['successRedirect'] == "yes") {
            echo '<p class="updated alert-success">Informations mises à jour avec succès.</p>';
        }
        ?>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <button class="btn btn-default" id="show_form_data">
                    Accéder à la modification des informations personnelles
                </button>
                <button class="btn btn-default" id="hide_form_data">
                    Cacher la modification des informations personnelles
                </button>
            </div>
            <div class="col-lg-6 col-sm-12">
                <button class="btn btn-default" id="show_form_data_connexion">
                    Accéder à la modification des informations de connexion
                </button>
                <button class="btn btn-default" id="hide_form_data_connexion">
                    Cacher la modification des informations de connexion
                </button>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container form-bg" id="div_personnal_profile">
        <h2>Formulaire de modification des informations personnelles</h2>
        <form id="form_personnal_profile" method="post" action="profile.php">
            <div class="row">
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="name">Nom *</label>
                    <input type="text" id="name" name="name"
                           class="form-control" value="<?php echo $user["name"] ?>">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="firstname">Prénom *</label>
                    <input type="text" id="firstname" name="firstname"
                    class="form-control" value="<?php echo $user["firstname"] ?>">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="birth_date">Date de naissance</label>
                    <input type="date" id="birth_date" name="birth_date"
                           class="form-control" value="<?php echo $user["birthdate"] ?>">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="sexe">Sexe *</label>
                    <select class="form-control" id="sexe" name="sexe">
                        <option value="" class="options_sexe">Sexe</option>
                        <option value="H" class="options_sexe"
                            <?php
                            if ($user["sexe"] === "H") {
                                echo "selected='selected'";
                            }
                            ?>
                        >Masculin</option>
                        <option value="F" class="options_sexe"
                        <?php
                        if ($user["sexe"] === "F") {
                            echo "selected='selected'";
                        }
                        ?>
                        >Féminin</option>
                        <option value="A" class="options_sexe"
                        <?php
                        if ($user["sexe"] === "A") {
                            echo "selected='selected'";
                        }
                        ?>
                        >Autres</option>
                    </select>
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="pseudo">Pseudo *</label>
                    <input type="text" id="pseudo" name="pseudo" class="form-control"
                           value="<?php echo $user["pseudo"] ?>">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="city">Ville *</label>
                    <select class="form-control" id="city" name="city">
                        <option value="" class="options_city">Ville</option>
                        <option value="Paris" class="options_city"
                        <?php
                        if ($user["city"] === "Paris") {
                            echo "selected='selected'";
                        }
                        ?>
                        >Paris</option>
                        <option value="Lyon" class="options_city"
                        <?php
                        if ($user["city"] === "Lyon") {
                            echo "selected='selected'";
                        }
                        ?>
                        >Lyon</option>
                        <option value="Marseille" class="options_city"
                        <?php
                        if ($user["city"] === "Marseille") {
                            echo "selected='selected'";
                        }
                        ?>
                        >Marseille</option>
                    </select>
                    <p class="comments"></p>
                </div>
                <div class="col-sm-12">
                    <p class="blue"><strong> * Ces informations sont requises.</strong></p>
                </div>
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-submit" value="Modifier vos informations personnelles.">
                </div>
            </div>
        </form>
    </div>

    <div class="container form-bg" id="div_connexion_profile">
        <h2>Formulaire de modification des informations de connexion</h2>
        <form id="form_connexion_profile" method="post" action="profile.php">
            <div class="row">
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email"
                           class="form-control" value="<?php echo $user["email"] ?>">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="email_check">Email confirmation *</label>
                    <input type="email" id="email_check" name="email_check"
                           class="form-control" value="<?php echo $user["email"] ?>">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="password_before">Ancien mot de passe *</label>
                    <input type="password" id="password_before" name="password_before"
                           class="form-control" placeholder="Ancien mot de passe">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="password">Nouveau mot de passe *</label>
                    <input type="password" id="password" name="password"
                           class="form-control" placeholder="Nouveau mot de passe">
                    <p class="comments"></p>
                </div>
                <div class="col-lg-6 col-sm-12 form-group">
                    <label for="password_check"> Confirmation mot de passe *</label>
                    <input type="password" id="password_check" name="password_check"
                           class="form-control" placeholder="Confirmer le mot de passe">
                    <p class="comments"></p>
                </div>
                <div class="col-md-12">
                    <p class="blue"><strong> * Ces informations sont requises.</strong></p>
                </div>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-submit" value="Modifier vos informations de connexion.">
                </div>
            </div>
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
