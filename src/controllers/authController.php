<?php

require_once '../src/models/UserRepository.php';

class AuthController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        if (empty($username) || !$email || empty($password)) {
            $error = "Tous les champs sont obligatoires.";
            include '../views/auth/register.php';
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user = new User(null, $username, $email, $hashedPassword);

        if ($this->userRepository->save($user)) {
            $this->redirect('index.php?page=login');
        } else {
            $error = "Une erreur est survenue lors de l'inscription.";
        }
    }

    include '../views/auth/register.php';
}

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
                $error = "Veuillez fournir un email valide et un mot de passe.";
                include '../views/auth/login.php';
                return;
            }

            $user = $this->userRepository->findByEmail($email);

            if ($user && password_verify($password, $user->getPassword())) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail()
                ];
                $this->redirect('index.php?page=posts');
            } else {
                $error = "Identifiants incorrects.";
            }
        }

        include '../views/auth/login.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $this->redirect('index.php?page=login');
    }

    private function redirect($url)
    {
        header("Location: $url");
        exit();
    }
}

// Avec une classe SessionManager, on pourrait gérer les sessions de manière centralisée.
// Le code ci-dessous est un exemple de la façon dont on pourrait l'utiliser dans un contrôleur d'authentification.

// authController.php :
// require_once '../src/models/UserRepository.php';
// require_once '../core/SessionManager.php';

// class AuthController
// {
//     private $userRepository;

//     public function __construct()
//     {
//         $this->userRepository = new UserRepository();
//     }

//     public function login()
//     {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $email = $_POST['email'];
//             $password = $_POST['password'];

//             if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
//                 $error = "Veuillez fournir un email valide et un mot de passe.";
//                 include '../views/auth/login.php';
//                 return;
//             }

//             $user = $this->userRepository->findByEmail($email);

//             if ($user && password_verify($password, $user->getPassword())) {
//                 SessionManager::start();
//                 SessionManager::set('user', [
//                     'id' => $user->getId(),
//                     'username' => $user->getUsername(),
//                     'email' => $user->getEmail()
//                 ]);
//                 $this->redirect('index.php?page=posts');
//             } else {
//                 $error = "Identifiants incorrects.";
//             }
//         }

//         include '../views/auth/login.php';
//     }


//     public function register()
//     {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $username = $_POST['username'];
//             $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//             $password = $_POST['password'];

//             if (!$username || !$email || !$password) {
//                 $error = "Tous les champs sont obligatoires.";
//                 include __DIR__ . '/../views/auth/register.php';
//                 return;
//             }

//             $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//             $user = new User(null, $username, $email, $hashedPassword);

//             if ($this->userRepository->save($user)) {
//                 $this->redirect('index.php?page=login');
//             } else {
//                 $error = "Une erreur est survenue lors de l'inscription.";
//             }
//         }

//         include '../views/auth/register.php';
//     }

//     public function logout()
//     {
//         SessionManager::start();
//         SessionManager::destroy();
//         $this->redirect('index.php?page=login');
//     }

//     private function redirect($url)
//     {
//         header("Location: $url");
//         exit();
//     }
// }

// core/SessionManager.php :
// class SessionManager
// {
//     public static function start()
//     {
//         if (session_status() === PHP_SESSION_NONE) {
//             session_start();
//         }
//     }

//     public static function set($key, $value)
//     {
//         $_SESSION[$key] = $value;
//     }

//     public static function get($key)
//     {
//         return $_SESSION[$key] ?? null;
//     }

//     public static function destroy()
//     {
//         if (session_status() === PHP_SESSION_ACTIVE) {
//             session_destroy();
//         }
//     }
// }

// Les contrôleurs contiennent la logique métier de l'application.
// AuthController.php gère les actions liées à l'authentification (connexion, inscription, déconnexion).
// Fonctionnalités possibles :
// Méthode login() : Gère la connexion des utilisateurs.
// Méthode register() : Gère l'inscription des utilisateurs.
// Méthode logout() : Gère la déconnexion des utilisateurs.