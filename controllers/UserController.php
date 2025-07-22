<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . "/../helpers/functions.php";
class UserController extends Controller
{
    public function login() : void
    {
        $csrf_token = getCsrfToken();
        self::render('user/login', ['csrf_token' => $csrf_token]);
    }

    public function doLogin() : void
    {
        checkCsrfToken();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $identifier = $_POST['email'] ?? ''; // champ email OU pseudo
            $password = $_POST['password'] ?? '';

            // Détection email ou pseudo
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $user = User::findByEmail($identifier);
            } else {
                $user = User::getByUsername($identifier);
            }

            if ($user && password_verify($password, $user['password'])){
                $_SESSION['user'] = [
                    'id' => $user['id'],
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
        self::render('user/register');
    }

    public function doRegister() : void
    {

    }

    public function dashboard() : void
    {
        checkConnect();
        self::render('user/dashboard');
    }

    public function showPhoto() : void
    {
        checkConnect();
        //ecrire le rtrste
    }
}