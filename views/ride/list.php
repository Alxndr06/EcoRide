<?php require_once __DIR__ . "/../partials/header.php"; ?>

<main>
<h1 class="page_title">Liste des trajets</h1>

<?php foreach ($rideList as $ride) : ?>
    <div class="ride_card_container">
        <strong><?= htmlspecialchars($ride['lieu_depart']) ?></strong><br>
        <?= date("d/m/Y", strtotime($ride['date_depart'])) ?> à <?= date("H:i", strtotime($ride['heure_depart'])) ?><br>
        <strong><?= htmlspecialchars($ride['lieu_arrivee']) ?></strong><br>
        <?= date("d/m/Y", strtotime($ride['date_arrivee'])) ?> à <?= date("H:i", strtotime($ride['heure_arrivee'])) ?><br>
        <strong><?= htmlspecialchars($ride['nb_place']) ?></strong> places disponibles • <strong><?= htmlspecialchars($ride['prix_personne']) ?> €</strong> / pers
        <form class="book_ride_form">
            <button class="book_ride_button">Réserver</button>
        </form>
    </div>
<?php endforeach; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
