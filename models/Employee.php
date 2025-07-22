<?php
require_once __DIR__ . '/../core/Model.php';

class Employee extends Model
{
    public static function getAll() : array
    {
        $db = self::getDB();
        $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE role_id = 2');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): ?array
    {
        $db = self::getDB();
        $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE id = ? AND role_id = 2');
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    }

}
