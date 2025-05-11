<?php
require_once 'core/Model.php';

class Covoiturage extends Model
{
    public static function getAll()
    {
        $db = self::getDB();

        $sql = "SELECT * FROM covoiturages ORDER BY date_depart, heure_depart";
        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
