<?php
require_once "../models/Users.php";

class Profile extends Users
{
    public $arrayPersonnal;
    public $arrayConnexion;
    private $user;

    public function getUserResult()
    {
        $select = "users.name, users.firstname, users.birthdate, users.sexe, users.email, users.pseudo, users.city";
        $from = "users";
        $where = "users.id";
        $id = $_SESSION['id'];
        $this->user = Users::getUser($select, $from, $where, $id);
        $this->writeProfileRender($this->user);
        return $this->user;
    }

    public function writeProfileRender($user)
    {
        echo '<div class="profile_img_bloc">
                <img class="img-thumbnail center_img_profile" src="webroot/images/profiles.png" alt="image_profiles">
              </div>
        <div class="row">
              <div class="col-3 col-sm-6">
                <div class="col-12">
                    <p class="data_profile">Nom : ' . $user["name"] . '</p>
                </div>
                <div class="col-12">
                    <p class="data_profile">Prénom : ' . $user["firstname"] . '</p>
                </div>
                 <div class="col-12">
                    <p class="data_profile">Date de naissance : ' . $user["birthdate"] . '</p>
                </div>
              </div>';
        $this->writeProfileRenderSecondPart($user);

        echo '</div>';
    }

    public function writeProfileRenderSecondPart($user)
    {
        echo '<div class="col-3 col-sm-6">
                <div class="col-12">
                    <p class="data_profile">Sexe : ' . $user["sexe"] . '</p>
                </div>
                <div class="col-12">
                    <p class="data_profile">Pseudo : ' . $user["pseudo"] . '</p>
                </div>
                <div class="col-12">
                    <p class="data_profile">Ville : ' . $user["city"] . '</p>
                </div>
            </div>
            <div class="col-12">
                <p class="data_profile">Email : ' . $user["email"] . '</p>
            </div>';
    }

    public function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function isPassword($password)
    {
        $strength = ['Protection excellente', 'Forte protection', 'Moyenne protection', 'Protection basse'];
        if ($this->enoughLength($password, 8) && $this->containMixedCase($password)
            && $this->containDigits($password) && $this->containSpecialChars($password)) {
            return $strength[0];
        } elseif ($this->enoughLength($password, 6) && $this->containMixedCase($password)
            && $this->containDigits($password)) {
            return $strength[1];
        } elseif ($this->enoughLength($password, 6) && $this->containSpecialChars($password)) {
            return $strength[1];
        } elseif ($this->enoughLength($password, 6) && $this->containMixedCase($password)) {
            return $strength[2];
        } elseif ($this->enoughLength($password, 6) && $this->containDigits($password)) {
            return $strength[2];
        } else {
            return $strength[3];
        }
    }

    private function enoughLength($password, $length)
    {
        if (empty($password)) {
            return false;
        } elseif (strlen($password) < $length) {
            return false;
        } else {
            return true;
        }
    }

    private function containMixedCase($password)
    {
        if (preg_match("/[a-z]+/", $password) && preg_match("/[A-Z]+/", $password)) {
            return true;
        } else {
            return false;
        }
    }

    private function containDigits($password)
    {
        if (preg_match("/\d/", $password)) {
            return true;
        } else {
            return false;
        }
    }

    private function containSpecialChars($password)
    {
        if (preg_match("/[^\da-zPDO::PARAM_STR]/", $password)) {
            return true;
        } else {
            return false;
        }
    }

    public function hashPassword($password, $email)
    {
        $keyPass = substr($email, 0, 4);
        $password = $keyPass . $password;
        $keyPass = substr($email, 0, 2);
        $password .= $keyPass;
        $password = hash("sha256", $password);
        return $password;
    }

    public function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function checkNumbers($data)
    {
        if (preg_match("#[0-9]+#", $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAdult($userBirthDate)
    {
        $currentTime = Date("Y-m-d");
        $currentDay = DateTime::createFromFormat("Y-m-d", $currentTime);
        $birthDate = DateTime::createFromFormat("Y-m-d", $userBirthDate);
        $result = date_diff($birthDate, $currentDay);
        if ($result->y < 18) {
            return false;
        } else {
            return true;
        }
    }

    public function isTooOld($userBirthDate)
    {
        $currentTime = Date("Y-m-d");
        $currentDay = DateTime::createFromFormat("Y-m-d", $currentTime);
        $birthDate = DateTime::createFromFormat("Y-m-d", $userBirthDate);
        $result = date_diff($birthDate, $currentDay);
        if ($result->y > 122) {
            return false;
        } else {
            return true;
        }
    }

    public function checkMailExist($mail)
    {
        $select = "users.email";
        $from = "users";
        $where = "users.email";
        $mail = strtolower($mail);
        if (Users::readMail($select, $from, $where, $mail)) {
            $this->arrayPersonnal["email_error"] = "Cette adresse mail a déjà été utilisée.";
            $this->arrayPersonnal["isSuccessConnexion"] = false;
        }
    }

    public function checkPseudoExist($pseudo)
    {
        $select = "users.pseudo";
        $from = "users";
        $where = "users.pseudo";
        if (Users::readPseudo($select, $from, $where, $pseudo)) {
            $this->arrayPersonnal["pseudo_error"] = "Ce pseudo a déjà été utilisé.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        }
    }

    public function initializeArrayPersonnal()
    {
        if (!empty($_POST)) {
            $this->arrayPersonnal = array(
                "firstname" => "", "name" => "", "sexe" => "", "birth_date" => "", "city" => "", "pseudo" => "",
                "firstname_error" => "", "name_error" => "", "sexe_error" => "", "birth_date_error" => "",
                "city_error" => "", "pseudo_error" => "", "isSuccessPersonnal" => false);
        }
    }

    public function initializeArrayConnexion()
    {
        if (!empty($_POST)) {
            $this->arrayConnexion = array(
                "password_before" => "", "email" => "", "email_check" => "", "password" => "", "password_check" => "",
                "password_before_error", "email_error" => "", "email_check_error" => "", "password_error" => "",
                "password_check_error" => "", "isSuccessConnexion" => false);
        }
    }

    public function organizeResponsePersonnal()
    {
        $this->initializeArrayPersonnal();
        $this->checkPostPersonnal();
        $this->checkDataOutNumbers();
        $this->checkDataPersonnal();
        if (empty($this->arrayPersonnal['pseudo_error'])) {
            $this->checkPseudoExist($this->arrayPersonnal['pseudo']);
        }
        $this->isSuccessPersonnal();
        return $this->arrayPersonnal;
    }

    public function organizeResponseConnexion()
    {
        $this->initializeArrayConnexion();
        $this->checkPostConnexion();
        $this->checkDataConnexion();
        if (empty($this->arrayConnexion['email_error'])) {
            $this->checkMailExist($this->arrayConnexion['email']);
        }
        $this->arrayConnexion['password_before'] =
            $this->hashPassword($this->arrayConnexion['password_before'], $this->arrayConnexion['email']);
        if (($this->checkPasswordBefore($this->arrayConnexion['password_before'])) === false) {
            $this->arrayConnexion['password_before_error'] = "Merci de confirmer votre ancien mot de passe ici.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        }
        $this->checkPasswordConnexion();
        $this->arrayConnexion['password'] =
            $this->hashPassword($this->arrayConnexion['password'], $this->arrayConnexion['email']);
        $this->isSuccessConnexion();
        return $this->arrayConnexion;
    }

    public function checkPostPersonnal()
    {
        if (!empty($_POST)) {
            $this->arrayPersonnal["firstname"] = $this->testInput($_POST["firstname"]);
            $this->arrayPersonnal["name"] = $this->testInput($_POST["name"]);
            $this->arrayPersonnal["sexe"] = $this->testInput($_POST["sexe"]);
            $this->arrayPersonnal["birth_date"] = $this->testInput($_POST["birth_date"]);
            $this->arrayPersonnal["city"] = $this->testInput($_POST["city"]);
            $this->arrayPersonnal["pseudo"] = $this->testInput($_POST["pseudo"]);
            $this->arrayPersonnal["isSuccessPersonnal"] = true;
        }
    }

    public function checkPostConnexion()
    {
        if (!empty($_POST)) {
            $this->arrayConnexion["email"] = $this->testInput($_POST["email"]);
            $this->arrayConnexion["email_check"] = $this->testInput($_POST["email_check"]);
            $this->arrayConnexion["password_before"] = $this->testInput($_POST["password_before"]);
            $this->arrayConnexion["password"] = $this->testInput($_POST["password"]);
            $this->arrayConnexion["password_check"] = $this->testInput($_POST["password_check"]);
            $this->arrayConnexion["isSuccessConnexion"] = true;
        }
    }

    public function checkDataOutNumbers()
    {
        if (empty($this->arrayPersonnal["name"])) {
            $this->arrayPersonnal["name_error"] = "Je voudrais aussi connaître ton nom !";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        } elseif ($this->checkNumbers($this->arrayPersonnal['name'])) {
            $this->arrayPersonnal["name_error"] = "Les nombres ne sont pas permis.";
        }
        if (empty($this->arrayPersonnal["firstname"])) {
            $this->arrayPersonnal["firstname_error"] = "Je veux connaître ton prénom.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        } elseif ($this->checkNumbers($this->arrayPersonnal['firstname'])) {
            $this->arrayPersonnal["firstname_error"] = "Les nombres ne sont pas permis.";
        }
    }

    public function checkDataPersonnal()
    {
        if (empty($this->arrayPersonnal["sexe"])) {
            $this->arrayPersonnal["sexe_error"] = "Je veux connaître ton sexe.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        }
        if (empty($this->arrayPersonnal["birth_date"])) {
            $this->arrayPersonnal["birth_date_error"] = "Sélectionner votre date de naissance.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        } elseif (!$this->isAdult($this->arrayPersonnal["birth_date"])) {
            $this->arrayPersonnal["birth_date_error"]
                = "Vous n'avez pas encore 18ans, merci de revenir le cas échéant.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        } elseif (!$this->isTooOld($this->arrayPersonnal['birth_date'])) {
            $this->arrayPersonnal["birth_date_error"] = "Allez-vous battre le record du monde de longévité ?";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        }
        if (empty($this->arrayPersonnal["pseudo"])) {
            $this->arrayPersonnal["pseudo_error"] = "Indiquer votre pseudo.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        }
        if (empty($this->arrayPersonnal["city"])) {
            $this->arrayPersonnal["city_error"] = "Renseigner votre ville.";
            $this->arrayPersonnal["isSuccessPersonnal"] = false;
        }
    }

    public function checkDataConnexion()
    {
        if (!$this->isEmail($this->arrayConnexion["email"])) {
            $this->arrayConnexion["email_error"] = "Cette information est obligatoire pour vos prochaines connexions";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        } elseif (!$this->isEmail($this->arrayConnexion["email_check"])
            && ($this->arrayConnexion["email"] !== $this->arrayConnexion["email_check"])) {
            $this->arrayConnexion["email_check_error"] = "Les deux adresses email ne correspondent pas.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        }
    }

    public function checkPasswordConnexion()
    {
        $strenghPassword = $this->isPassword($this->arrayConnexion["password"]);
        if (empty($this->arrayConnexion["password"])) {
            $this->arrayConnexion["password_error"] = "Déterminer votre mot de passe sécurisé.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        } elseif ($strenghPassword === "Protection basse") {
            $this->arrayConnexion["password_error"] = $strenghPassword . ". Veuillez renforcer votre mot de passe.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        } elseif (isset($this->arrayConnexion["password_check"])
            && ($this->arrayConnexion["password"] !== $this->arrayConnexion["password_check"])) {
            $this->arrayConnexion["password_check_error"] = "Merci d'indiquer le même mot de passe que précédemment.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        }
    }

    public function checkPasswordBefore($passwordBefore)
    {
        session_start();
        if (Users::checkPasswordFromId($passwordBefore, $_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function isSuccessPersonnal()
    {
        if ($this->arrayPersonnal["isSuccessPersonnal"]) {
            $set[0] = "name";
            $set[1] = "firstname";
            $set[2] = "city";
            $set[3] = "birthdate";
            $set[4] = "sexe";
            $set[5] = "pseudo";
            $values[0] = $this->arrayPersonnal['name'];
            $values[1] = $this->arrayPersonnal['firstname'];
            $values[2] = $this->arrayPersonnal['city'];
            $values[3] = $this->arrayPersonnal['birth_date'];
            $values[4] = $this->arrayPersonnal['sexe'];
            $values[5] = $this->arrayPersonnal['pseudo'];
            session_start();
            $where = $_SESSION['id'];
            Users::updateUser($set, $values, $where);
        }
    }

    public function isSuccessConnexion()
    {
        if ($this->arrayConnexion["isSuccessConnexion"]) {
            $set[0] = "users.email";
            $set[1] = "users.password";
            $values[0] = strtolower($this->arrayConnexion['email']);
            $values[1] = $this->arrayConnexion['password'];
            $where = $_SESSION['id'];
            Users::updateUser($set, $values, $where);
        }
    }
}
