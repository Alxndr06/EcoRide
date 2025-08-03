<?php
require_once __DIR__ . '/../config/config.php';

function checkSession() : void {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function checkConnect(): void {
    checkSession();
    // Durée max de la session (20mn)
    $timeout = 1200;

    // Vérifie l'inactivité
    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $timeout) {
        session_unset();
        session_destroy();
        redirectWithWarning("Session expirée. Veuillez vous reconnecter.", "user", "login");
    }

    // Mise à jour de l'activité
    $_SESSION['last_activity'] = time();

    // Vérifie que l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        redirectWithError("Veuillez vous connecter pour accéder à cette page.", "user", "login");
    }
}

function getCsrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function checkCsrfToken(): void {
    if (
        empty($_POST['csrf_token']) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        redirectWithError("Le token CSRF est invalide.", 'home', 'index');
    }
}

// GESTION INFORMATIONS UTILISATEURS (USERS ET CONDUCTEURS)

function checkMethodPost() : void {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        die("Invalid request method.");
    }
}

function checkRole(int $expectedRoleId) : void {
    checkSession();
    if (!isset($_SESSION['user']) || (int) $_SESSION['user']['role_id'] !== $expectedRoleId) {
        redirectWithError('Accès refusé.', 'home', 'index');
    }
}

function isUserLoggedIn(): bool {
    checkSession();
    return isset($_SESSION['user']) && isset($_SESSION['user']['id']);
}

function redirectIfLoggedIn(): void {
    if (isUserLoggedIn()) {
        redirectWithError('Vous êtes déjà connecté.', 'home', 'index');
    }
}

// FONCTIONS DE DISPLAY DE MESSAGES ET AUTRES

function displayNoteStars($note) : string
{
    $stars = "";

    for ($i = 0; $i < floor($note); $i++) {
        $stars .= "⭐";
    }
    return $stars;
}

function displayWelcomeMessage(): string {
    if (isset($_SESSION['user'])) {
        $prenom = htmlspecialchars($_SESSION['user']['prenom'] ?? '');
        $nom = htmlspecialchars($_SESSION['user']['nom'] ?? '');
        $pseudo = htmlspecialchars($_SESSION['user']['pseudo'] ?? '');

        $displayName = $pseudo ?: ($prenom ?: $nom ?: 'Utilisateur');

        return "<p>Bonjour $displayName</p>";
    }
    return '';
}

function displayErrorOrSuccessMessage() : string {
    $message = '';

    if (isset($_SESSION['success'])) {
        $message = sprintf('<p class="success_message">%s</p>', $_SESSION['success']);
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        $message = sprintf('<p class="error_message">%s</p>', $_SESSION['error']);
        unset($_SESSION['error']);
    } elseif (isset($_SESSION['warning'])) {
        $message = sprintf('<p class="warning_message">%s</p>', $_SESSION['warning']);
        unset($_SESSION['warning']);
    } elseif (isset($_SESSION['information'])) {
        $message = sprintf('<p class="info_message">%s</p>', $_SESSION['information']);
        unset($_SESSION['information']);
    }
    return $message;
}


/* GESTION DES INPUTS */
function validateString(string $str) : bool {
    return preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $str);
}

/* GESTION DES REDIRECTIONS */
function redirectTo(string $controller, string $action) {
    header("Location: index.php?controller=$controller&action=$action");
    exit();
}

function redirectWithError(string $message, string $controller, string $action = 'index'): void {
    checkSession();
    $symbole = "⛔ ";
    $message = $symbole . $message;
    $_SESSION['error'] = $message;
    header("Location: index.php?controller=$controller&action=$action");
    exit();
}

function redirectWithSuccess(string $message, string $controller, string $action = 'index'): void {
    checkSession();
    $symbole = "✅ ";
    $message = $symbole . $message;
    $_SESSION['success'] = $message;
    header("Location: index.php?controller=$controller&action=$action");
    exit();
}
function redirectWithWarning(string $message, string $controller, string $action = 'index'): void {
    checkSession();
    $symbole = "⚠️ ";
    $message = $symbole . $message;
    $_SESSION['warning'] = $message;
    header("Location: index.php?controller=$controller&action=$action");
    exit();
}

function redirectWithInformation(string $message, string $controller, string $action = 'index'): void {
    checkSession();
    $symbole = "🪧 ";
    $message = $symbole . $message;
    $_SESSION['information'] = $message;
    header("Location: index.php?controller=$controller&action=$action");
    exit();
}

function redirectIfConnected(string $message) : void {
    if (isUserLoggedIn()) {
        redirectWithError($message, 'home', 'index');
    }
}