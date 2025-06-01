<?php
require_once __DIR__ . "/views/partials/header.php";

// Formatage de la date
$date = new DateTime($ride['date_depart']);
$formatter = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    'EEEE d MMMM'
);
?>

<main>
    <h1 class="page_title">Détails du trajet</h1>

    <section class="ride_details_container">
        <h2 class="ride_date"><?= htmlspecialchars(ucfirst($formatter->format($date))); ?></h2>

        <!-- Visuel trajet stylisé -->
        <div class="route_diagram">
            <div class="route_point">
                <span class="symbol">●</span>
                <span class="city"><?= htmlspecialchars($ride['lieu_depart']) ?></span>
            </div>
            <div class="route_arrow">│</div>
            <div class="route_point">
                <span class="symbol">●</span>
                <span class="city"><?= htmlspecialchars($ride['lieu_arrivee']) ?></span>
            </div>
        </div>

        <div class="ride_detail">
            <span class="label">Départ :</span>
            <span class="value"><?= htmlspecialchars(date("H:i", strtotime($ride['heure_depart']))) ?></span>
        </div>
        <div class="ride_detail">
            <span class="label">Arrivée :</span>
            <span class="value"><?= htmlspecialchars(date("H:i", strtotime($ride['heure_arrivee']))) ?></span>
        </div>
        <div class="ride_detail">
            <span class="label">Conducteur :</span>
            <span class="value"><?= htmlspecialchars($ride['prenom']) ?> (⭐ <?= $ride['note_moyenne'] ?? 'N/A' ?>/5)</span>
        </div>

        <form class="book_ride_form" method="POST" action="">
            <button class="book_ride_button">Réserver</button>
        </form>
    </section>
</main>

<?php require_once __DIR__ . "/views/partials/footer.php"; ?>
