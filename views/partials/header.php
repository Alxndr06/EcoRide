<?php require_once __DIR__ . '/../../config/config.php' ?>
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
                <li><a href="#">Rechercher un trajet</a></li>
                <li><a href="#">Publier un trajet</a></li>
                <li><a href="#">Mon compte</a></li>
                <li><a href="index.php?controller=contact&action=contact">Contact</a></li>
            </ul>
        </nav>
    </header>