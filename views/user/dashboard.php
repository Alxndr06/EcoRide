<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main>
    <h2>Mon tableau de bord</h2>
    <?= displayErrorOrSuccessMessage(); ?>
    <?= displayWelcomeMessage(); ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
