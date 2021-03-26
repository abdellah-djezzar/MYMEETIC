<?php
require_once "../models/Inscription.php";

class Register extends Inscription
{
    public $array;
    public $arrayConnexion;
    private $login;
    private $password;
    private $id;

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
        if (Inscription::readMail($select, $from, $where, $mail)) {
            $this->array["email_error"] = "Cette adresse mail a déjà été utilisée.";
            $this->array["isSuccess"] = false;
        }
    }

    public function checkPseudoExist($pseudo)
    {
        $select = "users.pseudo";
        $from = "users";
        $where = "users.pseudo";
        if (Inscription::readPseudo($select, $from, $where, $pseudo)) {
            $this->array["pseudo_error"] = "Ce pseudo a déjà été utilisé.";
            $this->array["isSuccess"] = false;
        }
    }

    public function initializeArrayConnexion()
    {
        $this->arrayConnexion = array(
            "email_connexion" => "", "password_connexion" => "", "email_connexion_error" => "",
            "password_connexion_error" => "", "isSuccessConnexion" => false);
    }

    public function connexionResponse()
    {
        $this->initializeArrayConnexion();
        $this->checkPostConnexion();
        $this->checkDataConnexion();
        if ($this->checkValidMailMdp()) {
            $param[0] = "users.id, users.email, users.password";
            $param[1] = "users";
            $param[2] = "users.email";
            $param[3] = "users.password";
            $result = Inscription::checkOnConnexion($param, $this->login, $this->password);
            $this->id = $result["id"];
            $this->arrayConnexion['isSuccessConnexion'] = true;
            session_start();
            $_SESSION["id"] = $result["id"];
        } else {
            $this->arrayConnexion['email_connexion_error'] = "Les champs ne correspondent pas.";
            $this->arrayConnexion['isSuccessConnexion'] = false;
        }
        return $this->arrayConnexion;
    }

    public function checkPostConnexion()
    {
        if (!empty($_POST)) {
            if (isset($_POST["email_connexion"])) {
                $this->arrayConnexion["email_connexion"] = $this->testInput($_POST["email_connexion"]);
            }
            if (isset($_POST["password_connexion"])) {
                $this->arrayConnexion["password_connexion"] = $this->testInput($_POST["password_connexion"]);
            }
        }
    }

    public function checkDataConnexion()
    {
        if (!empty($_POST['password_connexion']) && !empty($_POST['email_connexion'])) {
            $pass = $this->testInput($_POST["password_connexion"]);
            $email = $this->testInput($_POST['email_connexion']);
            $this->arrayConnexion["password_connexion"] = $this->hashPassword($pass, $email);
        } else {
            $this->arrayConnexion['email_connexion_error'] = "Veuillez indiquer votre email.";
            $this->arrayConnexion['password_connexion_error'] = "Merci d'indiquer votre mot de passe.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        }
        if (!isset($_POST['password_connexion']) && isset($_POST['email_connexion'])) {
            $this->arrayConnexion['password_connexion_error'] = "Merci d'indiquer votre mot de passe.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        }
        if (isset($_POST['password_connexion']) && !isset($_POST['email_connexion'])) {
            $this->arrayConnexion['email_connexion_error'] = "Veuillez indiquer votre email.";
            $this->arrayConnexion["isSuccessConnexion"] = false;
        }
    }

    public function checkValidMailMdp()
    {
        $param[0] = "users.id, users.email, users.password";
        $param[1] = "users";
        $param[2] = "users.email";
        $param[3] = "users.password";

        $this->login = $this->arrayConnexion['email_connexion'];
        $this->password = $this->arrayConnexion['password_connexion'];
        if (!empty($this->login) && !empty($this->password)) {
            if (Inscription::checkOnConnexion($param, $this->login, $this->password)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function initializeArrayRegister()
    {
        if (!empty($_POST)) {
            $this->array = array(
                "firstname" => "", "name" => "", "sexe" => "", "birth_date" => "", "city" => "",
                "email" => "", "email_check" => "", "password" => "", "password_check" => "", "pseudo" => "",
                "firstname_error" => "", "name_error" => "", "sexe_error" => "", "birth_date_error" => "",
                "email_error" => "", "email_check_error" => "", "password_error" => "", "password_check_error" => "",
                "city_error" => "", "pseudo_error" => "", "isSuccess" => false);
        }
    }
    public function organizeResponse()
    {
        $this->initializeArrayRegister();
        $this->checkPost();
        $this->checkDataOutNumbers();
        $this->checkData();
        $this->checkComplexData();
        if (empty($this->array['email_error'])) {
            $this->checkMailExist($this->array['email']);
        }
        if (empty($this->array['pseudo_error'])) {
            $this->checkPseudoExist($this->array['pseudo']);
        }
        $this->checkPassword();
        $this->array['password'] =
            $this->hashPassword($this->array['password'], $this->array['email']);
        $this->isSuccess();
        return $this->array;
    }

    public function checkPost()
    {
        if (!empty($_POST)) {
            $this->array["firstname"] = $this->testInput($_POST["firstname"]);
            $this->array["name"] = $this->testInput($_POST["name"]);
            $this->array["sexe"] = $this->testInput($_POST["sexe"]);
            $this->array["birth_date"] = $this->testInput($_POST["birth_date"]);
            $this->array["city"] = $this->testInput($_POST["city"]);
            $this->array["email"] = $this->testInput($_POST["email"]);
            $this->array["email_check"] = $this->testInput($_POST["email_check"]);
            $this->array["password"] = $this->testInput($_POST["password"]);
            $this->array["password_check"] = $this->testInput($_POST["password_check"]);
            $this->array["pseudo"] = $this->testInput($_POST["pseudo"]);
            $this->array["isSuccess"] = true;
        }
    }

    public function checkDataOutNumbers()
    {
        if (empty($this->array["name"])) {
            $this->array["name_error"] = "Je voudrais aussi connaître ton nom !";
            $this->array["isSuccess"] = false;
        } elseif ($this->checkNumbers($this->array['name'])) {
            $this->array["name_error"] = "Les nombres ne sont pas permis.";
        }
        if (empty($this->array["firstname"])) {
            $this->array["firstname_error"] = "Je veux connaître ton prénom.";
            $this->array["isSuccess"] = false;
        } elseif ($this->checkNumbers($this->array['firstname'])) {
            $this->array["firstname_error"] = "Les nombres ne sont pas permis.";
        }
    }

    public function checkData()
    {
        if (empty($this->array["sexe"])) {
            $this->array["sexe_error"] = "Es-tu un homme ou une femme ?";
            $this->array["isSuccess"] = false;
        }
        if (empty($this->array["birth_date"])) {
            $this->array["birth_date_error"] = "Sélectionner votre date de naissance.";
        } elseif (!$this->isAdult($this->array["birth_date"])) {
            $this->array["birth_date_error"] = "Vous n'avez pas encore 18ans, merci de revenir le cas échéant.";
        } elseif (!$this->isTooOld($this->array['birth_date'])) {
            $this->array["birth_date_error"] = "Allez-vous battre le record du monde de longévité ?";
        }
        if (empty($this->array["pseudo"])) {
            $this->array["pseudo_error"] = "Indiquer votre pseudo.";
        }
        if (empty($this->array["city"])) {
            $this->array["city_error"] = "Renseigner votre ville.";
        }
    }

    public function checkComplexData()
    {
        if (!$this->isEmail($this->array["email"])) {
            $this->array["email_error"] = "Cette information est obligatoire pour vos prochaines connexions";
            $this->array["isSuccess"] = false;
        } elseif (!$this->isEmail($this->array["email_check"])
            && ($this->array["email"] !== $this->array["email_check"])) {
            $this->array["email_check_error"] = "Les deux adresses email ne correspondent pas.";
            $this->array["isSuccess"] = false;
        }
    }

    public function checkPassword()
    {
        $strenghPassword = $this->isPassword($this->array["password"]);
        if (empty($this->array["password"])) {
            $this->array["password_error"] = "Déterminer votre mot de passe sécurisé.";
            $this->array["isSuccess"] = false;
        } elseif ($strenghPassword === "Protection basse") {
            $this->array["password_error"] = $strenghPassword . ". Veuillez renforcer votre mot de passe.";
            $this->array["isSuccess"] = false;
        } elseif (isset($this->array["password_check"])
            && ($this->array["password"] !== $this->array["password_check"])) {
            $this->array["password_check_error"] = "Merci d'indiquer le même mot de passe que précédemment.";
            $this->array["isSuccess"] = false;
        }
    }


    public function isSuccess()
    {
        if ($this->array["isSuccess"]) {
            $insert = "users (name, firstname, city, email, birthdate, sexe, password, pseudo)";
            $param[0] = $this->array['name'];
            $param[1] = $this->array['firstname'];
            $param[2] = $this->array['city'];
            $param[3] = strtolower($this->array['email']);
            $param[4] = $this->array['birth_date'];
            $param[5] = $this->array['sexe'];
            $param[6] = $this->array['password'];
            $param[7] = $this->array['pseudo'];
            Inscription::insert($insert, $param);
        }
    }
}
