<?php
require_once __DIR__ . "/../partials/header.php";

?>

<main>
    <h1 class="page_title">Liste des trajets</h1>

    <?php foreach ($rideList as $ride) : ?>
        <a href="index.php?controller=ride&action=details&id=<?= $ride['covoiturage_id'] ?>" class="ride_card_link">
        <div class="ride_card_container">
                <img class="ride_pp_driver" src="data:image/jpeg;base64,<?= base64_encode($ride['photo']) ?>" alt="Photo">

                <div class="ride_card_driver">
                    <div class="driver_name"><?= htmlspecialchars($ride['prenom']) ?></div>
                    <div class="driver_rating">⭐ <?= $ride['note_moyenne'] ?? "N/A" ?>/5</div>
                </div>

                <div class="ride_card_places">
                    <?= htmlspecialchars($ride['nb_place']) ?> places
                </div>

                <div class="ride_card_middle">
                    <div class="ride_card_datetime"><?= date("d/m/Y H:i", strtotime($ride['date_depart'] . ' ' . $ride['heure_depart'])) ?></div>
                    <div class="ride_card_datetime"><?= date("d/m/Y H:i", strtotime($ride['date_arrivee'] . ' ' . $ride['heure_arrivee'])) ?></div>
                </div>

                <div class="ride_card_price"><?= htmlspecialchars($ride['prix_personne']) ?> €</div>
            </div>
        </a>
    <?php endforeach; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
