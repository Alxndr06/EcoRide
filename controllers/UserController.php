<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . "/../helpers/functions.php";
class UserController extends Controller
{
    public function login()
    {
        self::render('user/login');
    }

    public function doLogin()
    {
        checkCsrfToken();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = User::findByEmail($email);

            if ($user && password_verify($password, $user['password'])){
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'pseudo' => $user['pseudo'],
                    'role' => $user['role'],
                    'adresse' => $user['adresse'],
                    'date_naissance' => $user['date_naissance'],
                    'photo' => $user['photo']
                ];
                redirectWithSuccess('Connexion réussie !', 'user', 'dashboard');
            } else {
                redirectWithError('Identifiants invalides.', 'user', 'login');
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        redirectWithSuccess("Déconnexion réussie.", 'user', 'login');
    }

    public function register()
    {
        self::render('user/register');
    }

    public function doRegister()
    {

    }

    public function dashboard()
    {
        checkConnect();

        self::render('user/dashboard');
    }

    public function showPhoto()
    {
        checkConnect();
        //ecrire le rtrste
    }
}