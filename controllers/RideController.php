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
}