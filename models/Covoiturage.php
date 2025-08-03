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

    public static function search(array $filters): array
    {
        $db    = self::getDB();
        $sql   = "SELECT c.*, u.prenom, u.photo,
                          (
                            SELECT ROUND(AVG(note),1)
                            FROM avis
                            WHERE avis.conducteur_id = u.utilisateur_id
                              AND avis.statut = 'validé'
                          ) AS note_moyenne
                  FROM covoiturages c
                  JOIN utilisateurs u 
                    ON c.conducteur_id = u.utilisateur_id";

        $conds  = [];
        $params = [];

        // Filtre sur lieu de départ
        if (!empty($filters['lieu_depart'])) {
            $conds[]              = "c.lieu_depart LIKE :lieu_depart";
            $params[':lieu_depart'] = '%' . $filters['lieu_depart'] . '%';
        }

        // Filtre sur lieu d'arrivée
        if (!empty($filters['lieu_arrivee'])) {
            $conds[]                 = "c.lieu_arrivee LIKE :lieu_arrivee";
            $params[':lieu_arrivee'] = '%' . $filters['lieu_arrivee'] . '%';
        }

        // Filtre date exacte
        if (!empty($filters['date'])) {
            $conds[]           = "c.date_depart = :date";
            $params[':date']   = $filters['date'];
        }
        // ou plage de dates
        if (!empty($filters['date_from'])) {
            $conds[]                 = "c.date_depart >= :date_from";
            $params[':date_from']    = $filters['date_from'];
        }
        if (!empty($filters['date_to'])) {
            $conds[]               = "c.date_depart <= :date_to";
            $params[':date_to']    = $filters['date_to'];
        }

        // Prix minimum
        if (isset($filters['prix_min']) && $filters['prix_min'] !== '') {
            $conds[]               = "c.prix_personne >= :prix_min";
            $params[':prix_min']   = $filters['prix_min'];
        }
        // Prix maximum
        if (isset($filters['prix_max']) && $filters['prix_max'] !== '') {
            $conds[]               = "c.prix_personne <= :prix_max";
            $params[':prix_max']   = $filters['prix_max'];
        }

        // Nombre de places
        if (isset($filters['nb_place']) && $filters['nb_place'] !== '') {
            $conds[]               = "c.nb_place >= :nb_place";
            $params[':nb_place']   = $filters['nb_place'];
        }

        // On peut aussi forcer le statut si besoin, ex: only pending
        if (!empty($filters['status'])) {
            $conds[]               = "c.statut = :status";
            $params[':status']     = $filters['status'];
        }

        // Construit la clause WHERE
        if (count($conds) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conds);
        }

        // Tri par date etheure de départ
        $sql .= " ORDER BY c.date_depart, c.heure_depart";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
