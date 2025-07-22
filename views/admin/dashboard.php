<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="dashboard">
    <div class="header-spacer"></div>

    <section class="welcome">
        <p class="greeting">Pannel d'Administration</p>
        <p class="role">Utilisateurs en attente : <strong></strong></p>
    </section>

    <section class="actions">
        <a href="index.php?controller=user&action=list" class="btn">👥 Gérer les utilisateurs</a>
        <a href="index.php?controller=admin&action=employees" class="btn">🧑‍💼 Gérer les employés</a>
        <a href="index.php?controller=user&action=pending" class="btn">✅ Valider les comptes</a>
        <a href="index.php?controller=ride&action=all" class="btn">🛣 Tous les trajets</a>
        <a href="index.php?controller=voiture&action=all" class="btn">🚘 Tous les véhicules</a>
        <a href="index.php?controller=avis&action=all" class="btn">📝 Avis utilisateurs</a>
        <a href="index.php?controller=parametres&action=index" class="btn">⚙️ Paramètres du site</a>
    </section>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
