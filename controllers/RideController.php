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

}