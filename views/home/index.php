<?php require_once __DIR__ . "/../partials/header.php"; ?>

<main>
    <div class="main_search_area">
            <form class="search_form">
                <input type="text" id="depart" name="depart" placeholder="Départ">
                <input type="text" id="destination" name="destination" placeholder="Destination">
                <button type="submit" name="search" id="search" title="Lancer la recherche">Rechercher</button>
            </form>
    </div>

    <span class="section_separator"></span>

    <ul>
        <li><a href="index.php?controller=ride&action=list">Voir les trajets</a></li>
        <!-- Tu pourras ajouter ici "Créer un trajet", "Connexion", etc. -->
    </ul>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>