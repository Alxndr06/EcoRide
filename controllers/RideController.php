<?php
require_once 'core/Controller.php';
require_once 'models/Covoiturage.php';

class RideController extends Controller
{
    public function list()
    {
        $rideList = Covoiturage::getAll();
        // Je lui donne les données de rideList enrobées dans un tableau associatif
        self::render('ride/list', ['rideList' => $rideList]);
    }

    public function details()
    {

        if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("ID de trajet invalide.");
        }

        $id = (int) $_GET['id'];
        $rideDetails = Covoiturage::showDetails($id);

        if (!$rideDetails) {
            die("Trajet non trouvé.");
        }

        self::render('ride/details', ['ride' => $rideDetails]);
    }

    public static function create() : void {
        checkConnect();
        self::render('ride/create');
    }

    public function store(): void {
        checkConnect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lieu_depart = trim($_POST['lieu_depart']);
            $heure_depart = $_POST['heure_depart'];
            $lieu_arrivee = trim($_POST['lieu_arrivee']);
            $heure_arrivee = $_POST['heure_arrivee'];
            $date = $_POST['date'];
            $duree = $_POST['duree'] ?? null;
            $prix = $_POST['prix_personne'] ?? null;
            $nb_place = intval($_POST['nb_place']);

            $chauffeur_id = $_SESSION['user']['id'];

            $success = Covoiturage::create([
                'lieu_depart' => $lieu_depart,
                'heure_depart' => $heure_depart,
                'lieu_arrivee' => $lieu_arrivee,
                'heure_arrivee' => $heure_arrivee,
                'date' => $date,
                'duree' => $duree,
                'prix_personne' => $prix,
                'nb_place' => $nb_place,
                'chauffeur_id' => $chauffeur_id
            ]);

            if ($success) {
                redirectWithSuccess("Trajet créé avec succès !", 'ride', 'list');
            } else {
                redirectWithError("Erreur lors de la création du trajet.", 'ride', 'create');
            }
        }
    }

    public function search(): void
    {
        $filters = [
            'lieu_depart'   => $_GET['lieu_depart']   ?? '',
            'lieu_arrivee'  => $_GET['lieu_arrivee']  ?? '',
            'date'          => $_GET['date']          ?? '',
            'date_from'     => $_GET['date_from']     ?? '',
            'date_to'       => $_GET['date_to']       ?? '',
            'prix_min'      => $_GET['prix_min']      ?? '',
            'prix_max'      => $_GET['prix_max']      ?? '',
            'nb_place'      => $_GET['nb_place']      ?? '',
            'status'        => $_GET['status']        ?? '',
        ];

        $anyFilter = array_filter($filters, function($v){ return $v !== ''; });
        if (empty($anyFilter)) {
            // on passe simplement les filtres vides pour pré-remplir le formulaire
            self::render('ride/search', ['filters' => $filters]);
            return;
        }

        $rideList = Covoiturage::search($filters);

        self::render('ride/search_results', [
            'rideList' => $rideList,
            'filters'  => $filters
        ]);
    }

}