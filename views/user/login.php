<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main>
    <h2>Connexion</h2>
    <?= displayErrorOrSuccessMessage(); ?>
    <?php $csrf_token = getCsrfToken(); ?>
    <form action="index.php?controller=user&action=doLogin" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">

        <label for="email">E-mail :</label>
        <input name="email" id="email" type="email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

        <label for="password">Mot de passe :</label>
        <input name="password" id="password" type="password" required>

        <button type="submit">Se connecter</button>
    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
