<?php
/* DB */
if (!defined('DB_HOST')) {
    define('DB_HOST', 'localhost');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'ecoride');
}
if (!defined('DB_USER')) {
    define('DB_USER', 'root');
}
if (!defined('DB_PASS')) {
    define('DB_PASS', '');
}

// Détection automatique du chemin
if (!defined('BASE_URL')) {
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    define('BASE_URL', rtrim($basePath, '/'));
}