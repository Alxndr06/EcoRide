<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . "/../helpers/functions.php";
class UserController extends Controller
{
    public function login() : void
    {
        checkSession();
        redirectIfLoggedIn();
        $csrf_token = getCsrfToken();
        self::render('user/login', ['csrf_token' => $csrf_token]);
    }

    public function doLogin() : void
    {
        checkSession();
        checkCsrfToken();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            redirectIfLoggedIn();
            $identifier = $_POST['email']; // champ email OU pseudo (thug life)
            $password = $_POST['password'];

            // Détection email ou pseudo
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $user = User::findByEmail($identifier);
            } else {
                $user = User::findByUsername($identifier);
            }

            if ($user && password_verify($password, $user['password'])){
                $_SESSION['user'] = [
                    'id' => $user['utilisateur_id'],
                    'email' => $user['email'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'pseudo' => $user['pseudo'],
                    'role_id' => $user['role_id'],
                    'role_libelle' => $user['role_libelle'],
                    'adresse' => $user['adresse'],
                    'date_naissance' => $user['date_naissance'],
                    'photo' => $user['photo']
                ];
                $_SESSION['last_activity'] = time();

                redirectWithSuccess("Connecté avec succès", 'home');
            } else {
                redirectWithError('Identifiants invalides.', 'user', 'login');
            }
        }
    }

    public function logout() : void
    {
        session_unset();
        session_destroy();
        redirectWithSuccess("Déconnexion réussie.", 'user', 'login');
    }

    public function register() : void
    {
        checkSession();
        redirectIfLoggedIn();
        $csrf_token = getCsrfToken();
        self::render('user/register', ['csrf_token' => $csrf_token]);
    }

    public function doRegister(): void
    {
        checkSession();
        checkCsrfToken();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = preg_replace('/\s+/', '', trim($_POST['pseudo']));
            $lastname = trim($_POST['nom']);
            $firstname = trim($_POST['prenom']);
            $email = strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
            $passwordRaw = $_POST['password'] ?? '';
            $confirmPasswordRaw = $_POST['confirm_password'] ?? '';
            $adress = $_POST['adresse'] ?? '';
            $birthdate = $_POST['date_naissance'] ?? '';
            $photo = null;
            $role = 1;

            // Tableau d'erreurs qui va nous pop au museau si on cumule les erreurs.
            $errors = [];

            // Validation
            if (empty($username) || empty($lastname) || empty($email) || empty($passwordRaw)) {
                $errors[] ="Merci de remplir tous les champs obligatoires.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Adresse e-mail invalide.";
            }

            if ($passwordRaw !== $confirmPasswordRaw) {
                $errors[] = "Les mots de passe ne correspondent pas.";
            }

            if (!User::checkUnicity('email', $email)) {
                $errors[] = "Cet email est déjà enregistré.";
            }

            if (!User::checkUnicity('pseudo', $username)) {
                $errors[] = "Ce pseudo est déjà utilisé.";
            }

            if (!empty($errors)) {
                redirectWithError(implode('<br>', $errors), 'user', 'register');
                return;
            }

            // Upload de la pp (blob)
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] !== UPLOAD_ERR_NO_FILE) {
                if ($_FILES['photo']['error'] === UPLOAD_ERR_OK && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    $photo = file_get_contents($_FILES['photo']['tmp_name']);
                } else {
                    redirectWithError("Erreur lors du téléchargement de la photo de profil.", 'user', 'register');
                    return;
                }
            }

            $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

            $success = User::create([
                'pseudo' => $username,
                'nom' => $lastname,
                'prenom' => $firstname,
                'email' => $email,
                'password' => $password,
                'adresse' => $adress,
                'date_naissance' => $birthdate,
                'photo' => $photo,
                'role_id' => $role
            ]);

            if ($success) {
                redirectWithSuccess("Compte créé avec succès ! Vous pouvez vous connecter.", 'user', 'login');
            } else {
                redirectWithError("Une erreur est survenue lors de l'enregistrement.", 'user', 'register');
            }
        }
    }

    public function dashboard() : void
    {
        checkConnect();
        self::render('user/dashboard');
    }

    public function showPhoto() : void
    {
        checkConnect();
        //TODO : ecrire le rtrste
    }
}