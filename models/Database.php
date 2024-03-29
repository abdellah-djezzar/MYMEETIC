<?php

class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "meetic";
    private static $dbUser = "abdellah";
    private static $dbUserPassword = "abdellah";
    private static $connection = null;

    public static function connect()
    {
        try {
            self::$connection = new PDO(
                "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                self::$dbUser,
                self::$dbUserPassword,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return self::$connection;
    }

    public static function disconnect()
    {
        self::$connection = null;
    }
}
