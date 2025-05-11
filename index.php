<?php
// On charge la configuration
require_once 'config/config.php';
// On charge le système de routing
require_once 'core/Router.php';

// Instanciation du routeur
$router = new Router();
// traitement de requête
$router->handleRequest();

