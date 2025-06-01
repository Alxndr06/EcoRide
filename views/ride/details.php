<?php require_once __DIR__ . "/../partials/header.php"; ?>

<main>
    <h1 class="page_title">Détails du trajet</h1>

    <section class="ride_details_container">
        <h2 class="ride_date"><?= htmlspecialchars(ucfirst($ride['date_formatee'])); ?></h2>
        <div class="route_details">
            <div class="route_point">
                <span class="label">Départ: </span>
                <span class="city"><?= htmlspecialchars(date("H:i", strtotime($ride['heure_depart']))) ?> - <?= htmlspecialchars($ride['lieu_depart']) ?></span>
            </div>
            <span class="travel_time"><?= htmlspecialchars($ride['duree']) ?></span>
            <div class="route_point">
                <span class="label">Arrivée: </span>
                <span class="city"><?= htmlspecialchars(date("H:i", strtotime($ride['heure_arrivee']))) ?> - <?= htmlspecialchars($ride['lieu_arrivee']) ?></span>
            </div>
        </div>
        <hr class="section_separator">
        <div class="car_details">
            <span class="driver_vehicle"><?= htmlspecialchars($ride['marque_modele']) ?> <?= htmlspecialchars(strtolower($ride['couleur'])) ?> -
            <?= htmlspecialchars($ride['energie']) ?></span>
        </div>
        <hr class="section_separator">
        <div class="driver_detail">
            <span class="picture"><img class="ride_pp_driver" src="data:image/jpeg;base64,<?= base64_encode($ride['photo']) ?>" alt="Photo"></span>
            <span class="value"><?= htmlspecialchars($ride['prenom']) ?> (<?= $ride['note_moyenne'] ? '⭐' . $ride['note_moyenne'] . '/5' : 'Pas de note' ?>)</span>
        </div>
        <form class="book_ride_form" method="POST" action="">
            <button class="book_ride_button">Réserver</button>
        </form>
    </section>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
