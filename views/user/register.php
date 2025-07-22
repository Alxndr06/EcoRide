<?php
require_once __DIR__ . "/../partials/header.php";
require_once __DIR__ . "/../../helpers/functions.php";
?>

<main class="register-page">
    <div class="form-container">
        <h2>Créer mon compte</h2>
        <?= displayErrorOrSuccessMessage(); ?>

        <form action="index.php?controller=user&action=doRegister"
              method="POST"
              enctype="multipart/form-data"
              class="register-form">

            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token); ?>">

            <label for="pseudo">Pseudo</label>
            <input name="pseudo" id="pseudo" type="text" required placeholder="Votre pseudo">

            <label for="nom">Nom</label>
            <input name="nom" id="nom" type="text" required placeholder="Votre nom">

            <label for="prenom">Prénom</label>
            <input name="prenom" id="prenom" type="text" required placeholder="Votre prénom">

            <label for="email">E-mail</label>
            <input name="email" id="email" type="email" required placeholder="Votre adresse mail" autocomplete="email">

            <label for="adresse">Adresse</label>
            <input name="adresse" id="adresse" type="text" required placeholder="Votre adresse">

            <label for="date_naissance">Date de naissance</label>
            <input name="date_naissance" id="date_naissance" type="date" required>

            <label for="password">Mot de passe</label>
            <input name="password" id="password" type="password" required placeholder="Votre mot de passe" autocomplete="new-password">

            <label for="confirm_password">Confirmer mot de passe</label>
            <input name="confirm_password" id="confirm_password" type="password" required placeholder="Répéter mot de passe" autocomplete="new-password">

            <label for="photo">Photo de profil</label>
            <input type="file" name="photo" id="photo" accept="image/*">

            <button type="submit" class="btn-full">Créer mon compte</button>
            <button type="reset" class="btn-full">Effacer le formulaire</button>
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
