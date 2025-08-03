<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h1 class="page_title">Trouvez votre trajet</h1>

    <form method="get" action="index.php" class="search-page-form">
        <input type="hidden" name="controller" value="ride">
        <input type="hidden" name="action"     value="search">

        <div>
            <label for="lieu_depart">Départ</label>
            <input
                    type="text"
                    id="lieu_depart"
                    name="lieu_depart"
                    required
                    value="<?= htmlspecialchars($filters['lieu_depart'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="lieu_arrivee">Arrivée</label>
            <input
                    type="text"
                    id="lieu_arrivee"
                    name="lieu_arrivee"
                    required
                    value="<?= htmlspecialchars($filters['lieu_arrivee'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="date">Date</label>
            <input
                    type="date"
                    id="date"
                    name="date"
                    value="<?= htmlspecialchars($filters['date'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="nb_place">Nombre de places</label>
            <input
                    type="number"
                    id="nb_place"
                    name="nb_place"
                    min="1"
                    value="<?= htmlspecialchars($filters['nb_place'] ?? '') ?>"
            >
        </div>

        <button type="submit" class="btn-full">Rechercher</button>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
