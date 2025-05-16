<?php
require_once __DIR__ . "/../partials/header.php";
?>
<h1>Liste des trajets</h1>

<?php foreach ($rideList as $ride) : ?>
    <div class="ride_card_container">
        <strong><?= htmlspecialchars($ride['lieu_depart']) ?></strong> →
        <strong><?= htmlspecialchars($ride['lieu_arrivee']) ?></strong><br>
        Le <?= $ride['date_depart'] ?> à <?= $ride['heure_depart'] ?><br>
        <?= $ride['nb_place'] ?> places • <?= $ride['prix_personne'] ?> € / pers
    </div>
<?php endforeach; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
