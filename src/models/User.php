<?php

require_once '../src/models/Db.php';

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct($id = null, $username = null, $email = null, $password = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // Setters
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Méthodes statiques pour interagir avec la base de données
    public static function login($email, $password)
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            return new User($row['id'], $row['username'], $row['email'], $row['password']);
        }

        return null;
    }

    public static function register($username, $email, $password)
    {
        $pdo = Db::getInstance();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        return $stmt->execute([$username, $email, $hashedPassword]);
    }
}