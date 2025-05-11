<?php
class Controller {
    public static function render($view, $data = [])
    {
        // On extrait les données en variables
        extract($data); // transforme ['foo' => 'bar'] en $foo = 'bar'

        // construction du chemin vers la vue
        $file = "views/$view.php";

        // On vérifie que le fichier existe
        if (file_exists($file)) {
            require $file; // inclut le HTML de la vue
        } else {
            die("View '$view' not found.");
        }
    }
}