<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="dashboard">
    <div class="header-spacer"></div>
    <section class="welcome">
        <p class="greeting">Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']) ?> !</p>
        <p class="role">Rôle : <strong><?= htmlspecialchars(ucfirst($_SESSION['user']['role_libelle'])) ?></strong></p>
        <p class="credits">Crédits : <strong><?= intval($_SESSION['user']['credits'] ?? 0) ?></strong>🪙</p>
    </section>

    <section class="actions">
        <a href="index.php?controller=trajet&action=mesTrajets" class="btn">📅 Mes trajets à venir</a>
        <a href="index.php?controller=trajet&action=historique" class="btn">📚 Historique</a>
        <a href="index.php?controller=trajet&action=ajouter" class="btn">➕ Ajouter un trajet</a>
        <a href="index.php?controller=voiture&action=mesVehicules" class="btn">🚗 Mes véhicules</a>
        <a href="index.php?controller=user&action=profil" class="btn">👤 Mon profil</a>
    </section>
</main>


<?php require_once __DIR__ . '/../partials/footer.php'; ?>
