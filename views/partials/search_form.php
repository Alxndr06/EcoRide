<?php
$today = date('Y-m-d');
$max = date('Y-m-d', strtotime('+6 month'));

/* include 'partials/search_form.php' */
?>

<form class="search_form" method="GET" action="index.php">
    <input type="hidden" name="controller" value="ride">
    <input type="hidden" name="action" value="search">

    <input type="text" id="lieu_depart" name="lieu_depart" placeholder="Départ" required>

    <input type="text" id="lieu_arrivee" name="lieu_arrivee" placeholder="Destination" required>

    <input type="date" id="date" name="date"
           min="<?= $today ?>" max="<?= $max ?>" value="<?= $today ?>">

    <button type="submit" name="search" id="search" title="Lancer la recherche">Rechercher</button>
</form>
