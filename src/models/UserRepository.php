<?php

require_once '../src/models/Db.php';
require_once '../src/models/User.php';

class UserRepository
{
    public function findByEmail($email)
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['username'], $row['email'], $row['password']);
        }

        return null;
    }

    public function save(User $user)
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        return $stmt->execute([
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword()
        ]);
    }
}