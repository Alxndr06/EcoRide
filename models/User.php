<?php
require_once __DIR__ . '/../core/Model.php';
class User extends Model
{
    public static function findByEmail($email) : array
    {
        $db = self::getDB();
        $stmt = $db->prepare("
        SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.email = ?
    ");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getById($id) : array
    {
        $db = self::getDB();
        $stmt = $db->prepare("
        SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.utilisateur_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByUsername($username)
    {
        $db = self::getDB();
        $stmt = $db->prepare("
                SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        WHERE u.pseudo = ?
        ");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll() : array
    {
        $db = self::getDB();
        $stmt = $db->query("
        SELECT u.*, r.libelle AS role_libelle
        FROM utilisateurs u
        JOIN roles r ON u.role_id = r.role_id
        ORDER BY u.nom, u.prenom
    ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}