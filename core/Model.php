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
            self::$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$db;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}