<?php
/*  $today = date('Y-m-d');
    $max = date('Y-m-d', strtotime('+1 month'));
    et ça à l'endroit où apparait la barre de recherche -> include 'partials/search_form.php';
      ^                                                           ^
    / ! \ A inclure dans chaque fichier utilisant le formulaire / ! \
   /_____\                                                     /_____\
*/
?>

<form class="search_form">
    <input type="text" id="depart" name="depart" placeholder="Départ" required>
    <input type="text" id="destination" name="destination" placeholder="Destination" required>
    <input type="date" id="date-depart" name="date-depart"
           min="<?= $today ?>" max="<?= $max ?>" value="<?= $today ?>">
    <button type="submit" name="search" id="search" title="Lancer la recherche">Rechercher</button>
</form>
