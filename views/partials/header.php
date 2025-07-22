<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../helpers/functions.php';

checkSession();

?>
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="EcoRide est une application française de covoiturage écolo.">
    <meta name="keywords" content="EcoRide, co-voiturage, covoit, covoiturage, ecologie">
    <meta name="author" content="Alexander AULONG">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/styles.css">
    <script src="<?= BASE_URL ?>/public/js/script.js" defer></script>
    <title>EcoRide</title>
</head>
<body>
<div class="page_wrapper">
    <header>
        <button id="burger" class="toggle_menu" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <h1><a title="Accueil du site" href="index.php?controller=home&action=index">EcoRide</a></h1>
        <nav id="main_navbar" class="main_nav">
            <ul>
                <li><a href="index.php?controller=home&action=index">Accueil</a></li>
                <li><a href="index.php?controller=ride&action=search">Rechercher un trajet</a></li>
                <li><a href="index.php?controller=ride&action=create">Publier un trajet</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="index.php?controller=user&action=dashboard">Tableau de bord</a></li>
                    <li><a href="index.php?controller=user&action=logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="index.php?controller=user&action=login">Connexion</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role_id'] === 3)): ?>
                   <li><a href="index.php?controller=admin&action=dashboard">Administration</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role_id'] === 2)): ?>
                    <li><a href="index.php?controller=employee&action=dashboard">Espace employé</a></li>
                <?php endif; ?>
                <li><a href="index.php?controller=contact&action=contact">Contact</a></li>
            </ul>
        </nav>
    </header>