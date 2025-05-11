<?php
class Model {
    protected static $db;

    // Methode de connexion unique
    protected static function getDB()
    {
        // Si déjà connecté, on renvoi la co
        if (self::$db) {
            return self::$db;
        }

        // Sinon on établit la connexion
        require 'config/config.php';

        try {
            self::$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$db;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}