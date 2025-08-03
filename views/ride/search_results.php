<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h1 class="page_title">Résultats de recherche</h1>

    <!-- On réaffiche le même formulaire, prérempli, pour affiner la recherche -->
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
        <button type="submit" class="btn-full">Filtrer</button>
    </form>

    <?php if (empty($rideList)): ?>
        <p>Aucun trajet trouvé pour ces critères.</p>
    <?php else: ?>
        <div class="ride-results">
            <?php foreach ($rideList as $ride): ?>
                <a href="index.php?controller=ride&action=details&id=<?= $ride['covoiturage_id'] ?>">
                    <div class="ride_card_container">
                        <img
                                src="data:image/jpeg;base64,<?= base64_encode($ride['photo']) ?>"
                                alt="photo conducteur"
                                class="ride_pp_driver"
                        >
                        <div>
                            <strong><?= htmlspecialchars($ride['prenom']) ?></strong><br>
                            De <?= htmlspecialchars($ride['lieu_depart']) ?>
                            à <?= htmlspecialchars($ride['lieu_arrivee']) ?><br>
                            Le <?= date("d/m/Y", strtotime($ride['date_depart'])) ?>
                            à <?= htmlspecialchars($ride['heure_depart']) ?><br>
                            Prix : <?= number_format($ride['prix_personne'], 2, ',', ' ') ?> €
                            – Places dispo : <?= (int)$ride['nb_place'] ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>