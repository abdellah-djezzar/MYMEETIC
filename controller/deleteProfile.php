<?php

include_once "../models/Users.php";

if (isset($_POST['deleteAccount'])) {
    if (!empty($_POST['deleteAccount'])) {
        if ($_POST['deleteAccount'] === "yes") {
            $user = new Users();
            $statement = $user::deleteUser($_SESSION['id']);
            session_unset();
        }
    }
}
