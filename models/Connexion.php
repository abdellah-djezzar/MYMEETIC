<?php

class Connexion
{
    public static function read($select, $from, $where, $order)
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT :select FROM :from WHERE :where ORDER BY :order");
        $statement->bindParam(":select", $select, PDO::PARAM_STR);
        $statement->bindParam(":from", $from, PDO::PARAM_STR);
        $statement->bindParam(":where", $where, PDO::PARAM_STR);
        $statement->bindParam(":order", $order, PDO::PARAM_STR);
        $result = $statement->execute();

        return $result;
    }
}
