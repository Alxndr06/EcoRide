<?php
$today = date('Y-m-d');
$max = date('Y-m-d', strtotime('+1 month'));

/* include 'partials/search_form.php' */
?>

<form class="search_form" method="GET" action="">
    <input type="text" id="depart" name="depart" placeholder="Départ" required>
    <input type="text" id="destination" name="destination" placeholder="Destination" required>
    <input type="date" id="date-depart" name="date-depart"
           min="<?= $today ?>" max="<?= $max ?>" value="<?= $today ?>">
    <button type="submit" name="search" id="search" title="Lancer la recherche">Rechercher</button>
</form>
