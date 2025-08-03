<?php
class Router {
    public function handleRequest()
    {
        // Lecture des paramètres dans l'URL
        $controllerName = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'index';

        // Cnstruction du nom du fichier contrôleur (on met la 1ere lettre en MAJ)
        $file = 'controllers/' . ucfirst($controllerName) . 'Controller.php';

        //On vérifie que le controller existe
        if (!file_exists($file)) {
            die("Controller '$controllerName' not found");
        }

        // On inclu le fichier
        require_once $file;

        // On construit le nom de la classe comme pour le controlleur
        $class = ucfirst($controllerName) . 'Controller';

        // On l'instancie
        $controller = new $class();

        //Vérification de l'existence de la méthode
        if(!method_exists($controller, $action)) {
            die("Action '$action' does not exist");
        }

        //Appel de la méthode
        $controller->$action();
    }

}
