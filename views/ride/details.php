<?php require_once __DIR__ . "/../partials/header.php"; ?>

<main>
    <h1 class="page_title">Détails du trajet</h1>

    <section class="ride_details_container">
        <h2 class="ride_date"><?= htmlspecialchars(ucfirst($ride['date_formatee'])); ?></h2>
        <p class="ride_seats"><?= htmlspecialchars($ride['nb_place']) ?> place<?= $ride['nb_place'] > 1 ? 's' : '' ?> disponible<?= $ride['nb_place'] > 1 ? 's' : '' ?></p>

        <div class="route_point">
            <span class="label">Départ :</span>
            <span><?= date("H:i", strtotime($ride['heure_depart'])) ?> – <?= htmlspecialchars($ride['lieu_depart']) ?></span>
        </div>

        <span class="travel_time">Durée estimée : <?= htmlspecialchars($ride['duree']) ?></span>

        <div class="route_point">
            <span class="label">Arrivée :</span>
            <span><?= date("H:i", strtotime($ride['heure_arrivee'])) ?> – <?= htmlspecialchars($ride['lieu_arrivee']) ?></span>
        </div>

        <hr class="section_separator">

        <div class="car_details">
            <span class="label">Véhicule :</span>
            <span><?= htmlspecialchars($ride['marque_modele']) ?> <?= htmlspecialchars(strtolower($ride['couleur'])) ?> – <?= htmlspecialchars($ride['energie']) ?></span>
        </div>

        <hr class="section_separator">

        <div class="driver_detail">
            <img class="ride_pp_driver" src="data:image/jpeg;base64,<?= base64_encode($ride['photo']) ?>" alt="Photo de <?= htmlspecialchars($ride['prenom']) ?>">
            <div class="driver_value"><?= htmlspecialchars($ride['prenom']) ?> (<?= $ride['note_moyenne'] ? '⭐ ' . $ride['note_moyenne'] . ' / 5' : 'Pas de note' ?>)</div>
        </div>

        <form class="book_ride_form" method="POST" action="">
            <button class="book_ride_button">Réserver</button>
        </form>
    </section>

    <div class="link_container">
        <a class="page_return_link" href="EcoRide/../index.php?controller=ride&action=list">← Retour à la liste des trajets</a>
    </div>
</main>

<?php require_once __DIR__ . "/../partials/footer.php"; ?>
