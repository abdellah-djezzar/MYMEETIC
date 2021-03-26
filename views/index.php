<?php

session_start();

define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT.DS. 'controller');
define('VIEWS', BASE_URL.DS. 'views');

if (isset($_SESSION['id'])) {
    header("Location: " . VIEWS . DS . "members.php");
}
require_once CONTROLLER . DS . 'Register.php';

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
<section class="section_img_register">
    <div class="container">
        <h2>Welcome to you !</h2>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="center_img">
                <img class="mouse_heart img-thumbnail" src="webroot/images/header_coeur.jpeg" alt="image_heart_mouse">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-thumbnail images-inscription" src="webroot/images/dating.jpeg" alt="image_heart_dating">
            </div>
            <div class="col-md-4">
                <img class="img-thumbnail images-inscription" src="webroot/images/hand_coeur.jpeg"
                     id="image_hand_heart" alt="image_hand_in_heart">
            </div>
            <div class="col-md-4">
                <img class="img-thumbnail images-inscription" src="webroot/images/dating.jpeg" alt="image_heart_dating">
            </div>
        </div>
    </div>
    <div class="container">
        <h3>
            A la découverte du genre humain à la travers les rencontres de tout types dans un cadre mystic.
            N'hésitez plus et partagez le moment présent avec de nouvelles personnes.
        </h3>
    </div>
</section>
<section class="section_register_form">
    <div class="container">
        <h3>Vous êtes déjà inscrit ?<br>
            Veuillez vous connecter.</h3>
        <button class="btn-primary" id="btn-modalConnexion" data-target="myModal">Connexion</button>
    </div>
    <div class="container">
        <div id="modalConnexion" class="modal-register modal-connexion">
            <div class="modal-register-content modal-connexion-content" id="modalContent">
                <span class="col-lg-1 col-md-12 popin-dismiss">X</span>
                <form id="connexion-form" method="post" action="index.php">
                    <div class="row row-connexion">
                        <div class="col-lg-4 col-md-12">
                            <label for="email_connexion" class="labels-connexion">Login / Email *</label>
                            <input type="email" id="email_connexion" name="email_connexion"
                                   class="form-control" placeholder="Votre email">
                            <p class="comments"></p>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <label for="password_connexion" class="labels-connexion">Mot de passe *</label>
                            <input type="password" id="password_connexion" name="password_connexion"
                                   class="form-control" placeholder="Votre mot de passe">
                            <p class="comments"></p>
                        </div>
                        <div class="col-lg-3 col-md-12">
                            <input type="submit" class="btn btn-submit" value="Se connecter">
                        </div>
                    </div>
                    <div class="container">

                    </div>
                </form>
                <div class="connexion_error">
                    <p>
                        <?php
                        if (isset($_POST['mail_connexion_error'])) {
                            echo $_POST['mail_connexion_error'];
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="open_register_form">
        <div class="container form-bg">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form id="register-form" method="post" action="index.php">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="name">Nom *</label>
                                <input type="text" id="name" name="name"
                                       class="form-control" placeholder="Votre nom">
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="firstname">Prénom *</label>
                                <input type="text" id="firstname" name="firstname"
                                       class="form-control"
                                       placeholder="Votre prénom">
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="birth_date">Date de naissance *</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control">
                                <p class="comments"></p>
                                <br>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="sexe">Sexe *</label>
                                <select class="form-control" id="sexe" name="sexe">
                                    <option value="" class="options_sexe">Sexe</option>
                                    <option value="H" class="options_sexe">Homme</option>
                                    <option value="F" class="options_sexe">Femme</option>
                                    <option value="A" class="options_sexe">Autres</option>
                                </select>
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="pseudo">Pseudo *</label>
                                <input type="text" id="pseudo" name="pseudo" class="form-control"
                                       placeholder="Votre pseudo">
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="city">Ville *</label>
                                <select class="form-control" id="city" name="city">
                                    <option value="" class="options_city">Ville</option>
                                    <option value="Paris" class="options_city">Paris</option>
                                    <option value="Lyon" class="options_city">Lyon</option>
                                    <option value="Marseille" class="options_city">Marseille</option>
                                </select>
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email"
                                       class="form-control" placeholder="Votre email">
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="email_check">Email confirmation *</label>
                                <input type="email" id="email_check" name="email_check"
                                       class="form-control" placeholder="Confirmez votre email">
                                <p class="comments"></p>
                            </div>
                            <div class="col-lg-6 col-sm-12 form-group">
                                <label for="password"> Mot de passe *</label>
                                <input type="password" id="password" name="password"
                                       class="form-control" placeholder="Votre mot de passe">
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
                                <input type="submit" class="btn btn-submit" value="Envoyer">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once "footer.html";
?>
<script src="webroot/js/jquery-3.3.1.min.js"></script>
<script src="webroot/js/register.js"></script>
</body>
</html>
