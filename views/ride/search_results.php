<?php
require_once __DIR__ . '/../partials/header.php';
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main>
    <h2>Résultats de recherche</h2>

    <?php if (empty($rideList)): ?>
        <p>Aucun trajet trouvé pour ces critères.</p>
    <?php else: ?>
        <?php foreach ($rideList as $ride): ?>
             <a href="index.php?controller=ride&action=details&id=<?= $ride['covoiturage_id'] ?>">
                <div class="ride_card_container">
                    <img src="data:image/jpeg;base64,<?= base64_encode($ride['photo']) ?>" alt="photo conducteur" class="ride_pp_driver">
                    <div>
                        <strong><?= htmlspecialchars($ride['prenom']) ?></strong><br>
                        De <?= htmlspecialchars($ride['lieu_depart']) ?> à <?= htmlspecialchars($ride['lieu_arrivee']) ?><br>
                        Le <?= date("d/m/Y", strtotime($ride['date_depart'])) ?> à <?= $ride['heure_depart'] ?><br>
                        Prix : <?= htmlspecialchars($ride['prix_personne']) ?> € / Place : <?= $ride['nb_place'] ?>
                    </div>
                </div>
             </a>
        <?php endforeach; ?>
    <?php endif; ?>
</main>


<?php require_once __DIR__ . '/../partials/footer.php'; ?>
