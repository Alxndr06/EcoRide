<?php require_once __DIR__ . "/../partials/header.php"; ?>

<main>
    <div class="main_search_area">
            <form class="search_form">
                <input type="text" id="depart" name="depart" placeholder="Départ" required>
                <input type="text" id="destination" name="destination" placeholder="Destination" required>
                <button type="submit" name="search" id="search" title="Lancer la recherche">Rechercher</button>
            </form>
    </div>

    <div class="section_separator"></div>
    <div class="second_part_index">
        <h1>EcoRide</h1>
        <p>Voyagez de manière écologique<br>
            avec des covoitureurs soucieux
            de l’environnement.</p>
    </div>
    <a href="index.php?controller=ride&action=list">Test des trajets</a>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>