<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="login-page">
    <div class="form-container">
        <h2>Connexion</h2>
        <?= displayErrorOrSuccessMessage(); ?>

        <form action="index.php?controller=user&action=doLogin" method="POST" class="login-form">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token); ?>">

            <label for="email">E-mail ou pseudo</label>
            <input name="email" id="email" type="text" required placeholder="Votre addresse e-mail ou pseudo">

            <label for="password">Mot de passe</label>
            <input name="password" id="password" type="password" required placeholder="Votre mot de passe">

            <button type="submit" class="btn-full">🔐 Se connecter</button>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
