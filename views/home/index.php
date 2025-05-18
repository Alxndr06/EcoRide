<?php
require_once __DIR__ . "/../partials/header.php";

$today = date('Y-m-d');
$max = date('Y-m-d', strtotime('+1 year'));
?>

<main>
    <div class="main_search_area">
            <form class="search_form">
                <input type="text" id="depart" name="depart" placeholder="Départ" required>
                <input type="text" id="destination" name="destination" placeholder="Destination" required>
                <input type="date" id="date-depart" name="date-depart"
                       min="<?= $today ?>" max="<?= $max ?>" value="<?= $today ?>">
                <button type="submit" name="search" id="search" title="Lancer la recherche">Rechercher</button>
            </form>
    </div>

    <div class="section_separator"></div>
    <div class="second_part_index">
        <h2>EcoRide</h2>
        <p>
            <strong>Bienvenue sur EcoRide</strong><br>
            Ensemble, roulons vers un avenir plus vert 🌍<br><br>

            Grâce à notre plateforme de covoiturage simple et solidaire, trouvez ou proposez facilement des trajets près de chez vous.<br>
            Que ce soit pour aller au travail, partir en week-end ou faire un trajet régulier,<br>
            partageons la route tout en réduisant notre impact écologique.<br><br>

            🚗 Moins de voitures, plus de rencontres, et une planète qui respire mieux.
            <br><br>
        </p>
        <div class="section_separator"></div>
        <h2>Des actes plutôt que de belles paroles</h2>
        <p>
            Chez EcoRide, nous valorisons les conducteurs de véhicules propres 🚗💨<br>
            En réduisant notre marge, nous leur offrons une meilleure rémunération.<br>
            Moins d’émissions, plus de reconnaissance 🌱
            <br><br>
        </p>

    </div>
    <a style="align-content: center;" href="index.php?controller=ride&action=list">Test d'affichage des trajets</a>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>