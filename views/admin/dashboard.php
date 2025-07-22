<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="dashboard">
    <div class="header-spacer"></div>

    <section class="welcome">
        <p class="greeting">Pannel d'Administration</p>
        <p class="role">Nombre total d'utilisateur : <strong></strong></p>
        <p class="role">Nombre total de trajets : <strong></strong></p>
    </section>

    <section class="actions">
        <a href="#" class="btn">👥 Gérer les utilisateurs</a>
        <a href="#" class="btn">🧑‍💼 Gérer les employés</a>
        <a href="#" class="btn">✅ Valider les avis</a>
        <a href="index.php?controller=ride&action=list" class="btn">🛣 Tous les trajets</a>
        <a href="#" class="btn">🚘 Tous les véhicules</a>
        <a href="#" class="btn">📝 Avis utilisateurs</a>
        <a href="#" class="btn">⚙️ Paramètres du site</a>
    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
