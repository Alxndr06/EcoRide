<?php
require_once 'core/Model.php';

class Covoiturage extends Model
{
    public static function getAll()
    {
        $db = self::getDB();

        $sql = "SELECT covoiturages.*, utilisateurs.prenom, utilisateurs.photo,
                        (
                        SELECT ROUND(AVG(note), 1) 
                        FROM avis 
                        WHERE avis.conducteur_id = utilisateurs.utilisateur_id
                        AND avis.statut = 'validé'
                        )
                        AS note_moyenne
                FROM covoiturages
                JOIN utilisateurs ON covoiturages.conducteur_id = utilisateurs.utilisateur_id
                ORDER BY covoiturages.date_depart, covoiturages.heure_depart";
        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function showDetails($id)
    {
        $db = self::getDB();
        $sql = "SELECT covoiturages.*, utilisateurs.prenom, utilisateurs.photo, voitures.marque_id, marques.libelle ,voitures.modele,
                voitures.couleur, voitures.energie,
               (
                   SELECT ROUND(AVG(note), 1)
                   FROM avis
                   WHERE avis.conducteur_id = utilisateurs.utilisateur_id
                   AND avis.statut = 'validé'
               ) AS note_moyenne
        FROM covoiturages
        JOIN utilisateurs ON covoiturages.conducteur_id = utilisateurs.utilisateur_id
        JOIN voitures ON covoiturages.voiture_id = voitures.voiture_id
        JOIN marques ON voitures.marque_id = marques.marque_id
        WHERE covoiturage_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $ride = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$ride) {
            return null;
        }

        // Format de la date
        $date = new DateTime($ride['date_depart']);
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'Europe/Paris',
            IntlDateFormatter::GREGORIAN,
            'EEEE d MMMM'
        );
        $ride['date_formatee'] = $formatter->format($date);

        // Durée du trajet
        $depart = new DateTime($ride['date_depart'] . ' ' . $ride['heure_depart']);
        $arrivee = new DateTime($ride['date_arrivee'] . ' ' . $ride['heure_arrivee']);
        $interval = $depart->diff($arrivee);
        $duration = '';

        if ($interval->d > 0) {
            $duration .= $interval->d . 'j ';
        }
        $duration .= $interval->h . 'h';
        if ($interval->i > 0) {
            $duration .= $interval->i . 'min';
        }

        $ride['duree'] = $duration;

        // Véhicule du covoit

        $ride['marque_modele'] = $ride['libelle'] . ' ' . $ride['modele'];


        return $ride;
    }

    public static function create(array $data): bool {
        $db = self::getDB();

        $sql = "INSERT INTO covoiturages (lieu_depart, heure_depart, lieu_arrivee, heure_arrivee, date_depart, date_arrivee, duree, prix_personne, nb_place, conducteur_id)
            VALUES (:lieu_depart, :heure_depart, :lieu_arrivee, :heure_arrivee, :date, :date, :duree, :prix_personne, :nb_place, :conducteur_id)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            ':lieu_depart' => $data['lieu_depart'],
            ':heure_depart' => $data['heure_depart'],
            ':lieu_arrivee' => $data['lieu_arrivee'],
            ':heure_arrivee' => $data['heure_arrivee'],
            ':date' => $data['date'],
            ':duree' => $data['duree'],
            ':prix_personne' => $data['prix_personne'],
            ':nb_place' => $data['nb_place'],
            ':conducteur_id' => $data['conducteur_id']
        ]);
    }

    public static function search(string $lieu_depart, string $lieu_arrivee, string $date)
    {
        $db = self::getDB();

        $sql = "SELECT covoiturages.*, utilisateurs.prenom, utilisateurs.photo,
                   (
                       SELECT ROUND(AVG(note), 1)
                       FROM avis
                       WHERE avis.conducteur_id = utilisateurs.utilisateur_id
                       AND avis.statut = 'validé'
                   ) AS note_moyenne
            FROM covoiturages
            JOIN utilisateurs ON covoiturages.conducteur_id = utilisateurs.utilisateur_id
            WHERE lieu_depart LIKE :lieu_depart
              AND lieu_arrivee LIKE :lieu_arrivee
              AND date_depart = :date
            ORDER BY date_depart, heure_depart";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':lieu_depart' => "%$lieu_depart%",
            ':lieu_arrivee' => "%$lieu_arrivee%",
            ':date' => $date,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
