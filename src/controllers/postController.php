<?php

require_once '../src/models/Post.php'; // Charge le modèle Post

class PostController
{
    public function index()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        // Traitement du formulaire si soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $authorId = $_SESSION['user']['id']; // Utilisation de l'ID de l'utilisateur connecté

            Post::create($title, $content, $authorId);

            // Redirection pour éviter le renvoi du formulaire au refresh
            header('Location: index.php?page=posts');
            exit;
        }

        // Récupérer tous les posts
        $posts = Post::getAll(); // Retourne une liste d'objets Post
        include '../views/posts/index.php'; // Affiche la vue des posts
    }

    public function edit()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $postId = $_GET['id'];
        $post = Post::getById($postId); // Récupère un objet Post

        // Vérifier que l'utilisateur est bien l'auteur du post
        if ($post->getAuthorId() !== $_SESSION['user']['id']) {
            header('Location: index.php?page=posts');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            Post::update($postId, $title, $content);
            header('Location: index.php?page=posts');
            exit;
        }

        include '../views/posts/edit.php'; // Vue pour éditer le post
    }

    public function delete()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $postId = $_GET['id'];
        $post = Post::getById($postId); // Récupère un objet Post

        // Vérifier que l'utilisateur est bien l'auteur du post
        if ($post->getAuthorId() !== $_SESSION['user']['id']) {
            header('Location: index.php?page=posts');
            exit;
        }

        Post::delete($postId);
        header('Location: index.php?page=posts');
        exit;
    }
}

// Les contrôleurs contiennent la logique métier de l'application.
// PostController.php gère les actions liées aux "posts".
// Fonctionnalités possibles :
// Méthode index() : Affiche une liste de posts.
// Méthode edit() : Permet de modifier un post.
// Méthode delete() : Permet de supprimer un post.