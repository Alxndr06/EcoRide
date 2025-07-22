<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="register-page">
    <div class="form-container">
        <h2>Créer un trajet</h2>
        <?= displayErrorOrSuccessMessage(); ?>

        <form method="POST" action="index.php?controller=ride&action=doCreate">
            <label>Lieu de départ</label>
            <input type="text" name="lieu_depart" required>

            <label>Heure de départ</label>
            <input type="time" name="heure_depart" required>

            <label>Lieu d’arrivée</label>
            <input type="text" name="lieu_arrivee" required>

            <label>Heure d’arrivée</label>
            <input type="time" name="heure_arrivee" required>

            <label>Date du trajet</label>
            <input type="date" name="date" required>

            <label>Durée estimée</label>
            <input type="text" name="duree">

            <label>Prix par personne (credits)</label>
            <input type="number" step="1" name="prix_personne">

            <label>Nombre de places</label>
            <input type="number" name="nb_place" min="1" required>

            <button type="submit" class="btn-full">Créer le trajet</button>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
