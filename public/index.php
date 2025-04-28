<?php

require_once '../core/Router.php';
require_once '../src/controllers/PostController.php';
require_once '../src/controllers/AuthController.php';

session_start();

$router = new Router();
$router->addRoute('posts', PostController::class, 'index');
$router->addRoute('editPost', PostController::class, 'edit');
$router->addRoute('deletePost', PostController::class, 'delete');
$router->addRoute('login', AuthController::class, 'login');
$router->addRoute('register', AuthController::class, 'register');
$router->addRoute('logout', AuthController::class, 'logout');

$page = $_GET['page'] ?? 'posts';
$router->dispatch($page);

// Point d'entrée (index.php) :
// Le fichier index.php est le point d'entrée principal de l'application.
// Il inclut les fichiers nécessaires (Router.php, PostController.php, AuthController.php).
// Il initialise le système de routage et détermine quelle action ou quel contrôleur doit être exécuté en fonction de la valeur du paramètre page dans l'URL :
    // Il initialise une instance de la classe Router.
    // Il ajoute des routes spécifiques à l'application (par exemple, posts, editPost, login, etc.).
    // Il récupère la valeur du paramètre page dans l'URL ($_GET['page']) et utilise le routeur pour exécuter la méthode correspondante.
// La session est démarrée avec session_start(), ce qui permet de gérer des données utilisateur persistantes (comme l'état de connexion).