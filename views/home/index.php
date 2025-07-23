<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main>
    <?= displayErrorOrSuccessMessage(); ?>
    <div class="main_search_area">
        <?php include __DIR__ . '/../partials/search_form.php'; ?>
    </div>

    <div class="section_separator"></div>
    <div class="second_part_index">
        <h2>EcoRide, en bref.</h2>
        <p>
            Ensemble, roulons vers un avenir plus vert 🌍<br><br>

            Grâce à notre plateforme de covoiturage simple et solidaire, trouvez ou proposez facilement des trajets près de chez vous.<br>
            Que ce soit pour aller au travail, partir en week-end ou faire un trajet régulier,<br>
            partageons la route tout en réduisant notre impact écologique.<br><br>

            🚗 Moins de voitures, plus de rencontres, et une planète qui respire mieux.
            <br><br>

        <h2>Des actes plutôt que de belles paroles</h2>
        <p>
            Chez EcoRide, nous valorisons les conducteurs de véhicules propres 🚗💨<br>
            En réduisant notre marge, nous leur offrons une meilleure rémunération.<br>
            Moins d’émissions, plus de reconnaissance 🌱
            <br><br>
        </p>

        <div class="section_separator"></div>

    </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>