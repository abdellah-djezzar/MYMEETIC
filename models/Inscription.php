<?php

require_once "Database.php";

class Inscription extends Database
{
    public static function readMail($select, $from, $where, $mail)
    {
        $db = Database::connect();

        $statement = $db->prepare("SELECT " . $select . " FROM " . $from . " WHERE " . $where . " = :mail");
        $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        Database::disconnect();
        return $result;
    }

    public static function readPseudo($select, $from, $where, $pseudo)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT " . $select . " FROM " . $from . " WHERE " . $where . " = :pseudo");
        $statement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        Database::disconnect();
        return $result;
    }

    public static function insert($insert, $param)
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO " . $insert .
            " VALUES (:name, :firstname, :city, :email, :birthdate, :sexe, :password, :pseudo)");
        $statement->bindParam(':name', $param[0], PDO::PARAM_STR);
        $statement->bindParam(':firstname', $param[1], PDO::PARAM_STR);
        $statement->bindParam(':city', $param[2], PDO::PARAM_STR);
        $statement->bindParam(':email', $param[3], PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $param[4], PDO::PARAM_STR);
        $statement->bindParam(':sexe', $param[5], PDO::PARAM_STR);
        $statement->bindParam(':password', $param[6], PDO::PARAM_STR);
        $statement->bindParam(':pseudo', $param[7], PDO::PARAM_STR);
        $result = $statement->execute();
        Database::disconnect();
        return $result;
    }

    public static function checkOnConnexion($param, $mail, $password)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT " . $param[0] . " FROM " . $param[1] . " WHERE " . $param[2] .
            " = :email AND " . $param[3] . " = :password");
        $statement->bindParam(':email', $mail, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        Database::disconnect();
        return $result;
    }
}
