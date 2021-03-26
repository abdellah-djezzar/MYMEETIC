<?php

require_once "Database.php";

class Users extends Database
{
    public static function getUser($select, $from, $where, $id)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT " . $select. " FROM " . $from . " WHERE " . $where ." = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }

    public static function getUsersByCity($select, $from, $where, $city)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT " . $select. " FROM " . $from . " WHERE " . $where ." = :city");
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }

    public static function getUsersByParam($request, $where)
    {
        $db = Database::connect();
        $statement = $db->prepare($request);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }

    public static function checkPasswordFromId($password, $id)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT users.id FROM users 
                      WHERE users.id = :id AND users.password = :password");
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }

    public static function updateUser($set, $values, $where)
    {
        $db = Database::connect();
        if (count($values) == 6) {
            $statement = $db->prepare("UPDATE users SET " . $set[0]. " = :name" . ", " . $set[1].
                " = :firstname" . ", " . $set[2]. " = :city" . ", " . $set[3]. " = :birthdate" . ", " . $set[4].
                " = :sexe" . ", " . $set[5]. " = :pseudo" . " WHERE users.id = :id");
            $statement->bindParam(':name', $values[0], PDO::PARAM_STR);
            $statement->bindParam(':firstname', $values[1], PDO::PARAM_STR);
            $statement->bindParam(':city', $values[2], PDO::PARAM_STR);
            $statement->bindParam(':birthdate', $values[3], PDO::PARAM_STR);
            $statement->bindParam(':sexe', $values[4], PDO::PARAM_STR);
            $statement->bindParam(':pseudo', $values[5], PDO::PARAM_STR);
            $statement->bindParam(':id', $where, PDO::PARAM_STR);
            $statement->execute();
        }
        if (count($values) == 2) {
            $statement = $db->prepare("UPDATE users SET " . $set[0]. " = :email" . ", " . $set[1] .
                " = :password" . " WHERE users.id = :id");
            $statement->bindParam(':email', $values[0], PDO::PARAM_STR);
            $statement->bindParam(':password', $values[1], PDO::PARAM_STR);
            $statement->bindParam(':id', $where, PDO::PARAM_STR);
            $statement->execute();
        }
        Database::disconnect();
    }

    public static function deleteUser($id)
    {
        $db = Database::connect();
        $statement = $db->prepare("UPDATE users SET users.active = 0 WHERE users.id = :id");
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
        Database::disconnect();
        return $statement;
    }

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
}
