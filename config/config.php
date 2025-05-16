<?php
/* DB */
$host = 'localhost';
$dbname = 'ecoride';
$user = 'root';
$pass = '';

/* Constantes */

// Détection automatique du chemin
if (!defined('BASE_URL')) {
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    define('BASE_URL', rtrim($basePath, '/'));
}


//if (!defined('BASE_URL')) {
//    define('BASE_URL', '/Ecoride');
//};
