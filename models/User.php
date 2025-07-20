<?php
require_once __DIR__ . '/../core/Model.php';
class User extends Model
{
    public static function findByEmail($email)
    {
        $db = self::getDB();
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // retourne un tableau associatif

    }

}