<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main>
    <h1 class="page_title">Resultats des recherches</h1>
    <form method="GET" action="index.php">
        <input type="hidden" name="controller" value="ride">
        <input type="hidden" name="action" value="search">

        <label for="lieu_depart">Départ</label>
        <input type="text" name="lieu_depart" id="lieu_depart" required>

        <label for="lieu_arrivee">Arrivée</label>
        <input type="text" name="lieu_arrivee" id="lieu_arrivee" required>

        <label for="date">Date</label>
        <input type="date" name="date" id="date" required>

        <button type="submit" class="btn-full">Rechercher</button>
    </form>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>