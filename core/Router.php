<?php

class Router
{
    private $routes = [];

    public function addRoute($path, $controller, $method)
    {
        $this->routes[$path] = [$controller, $method];
    }

    public function dispatch($path)
    {
        if (isset($this->routes[$path])) {
            [$controller, $method] = $this->routes[$path];
            (new $controller())->$method();
        } else {
            echo "Page non trouvée.";
        }
    }
}

// Système de routage (Router.php) :
// Le fichier Router.php contient une classe qui gère les routes de l'application.
// Fonctionnalités possibles :
// Ajouter des routes avec addRoute().
// Associer des noms de routes à des méthodes spécifiques dans des contrôleurs.
// Exécuter la méthode appropriée en fonction de la route demandée via dispatch().