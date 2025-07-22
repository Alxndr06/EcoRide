<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="dashboard">
    <div class="header-spacer"></div>

    <section class="welcome">
        <p class="greeting">Pannel des Employés</p>
        <p class="role">Avis en attente : <strong>0</strong></p>
    </section>

    <section class="actions">
        <a href="index.php?controller=avis&action=all" class="btn">📝 Avis utilisateurs en attente</a>
    </section>
</main>


<?php require_once __DIR__ . '/../partials/footer.php'; ?>
