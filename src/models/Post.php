<?php

require_once '../src/models/Db.php';

class Post
{
    private $id;
    private $title;
    private $content;
    private $authorId;
    private $authorName;
    private $createdAt;

    public function __construct($id = null, $title = null, $content = null, $authorId = null, $createdAt = null, $authorName = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->authorId = $authorId;
        $this->authorName = $authorName;
        $this->createdAt = $createdAt;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getAuthorName()
    {
        return $this->authorName;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    // Setters
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    // Méthodes statiques pour interagir avec la base de données
    public static function getAll()
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->query('
            SELECT posts.*, users.username AS author_name 
            FROM posts 
            JOIN users ON posts.author_id = users.id 
            ORDER BY created_at DESC
        ');
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $posts = [];
        foreach ($results as $row) {
            $posts[] = new Post(
                $row['id'],
                $row['title'],
                $row['content'],
                $row['author_id'],
                $row['created_at'],
                $row['author_name']
            );
        }
    
        return $posts;
    }

    public static function create($title, $content, $authorId)
    {
        $pdo = Db::getInstance();
        $sql = "INSERT INTO posts (title, content, author_id) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $authorId]);
    }

    public static function getById($id)
    {
        $pdo = Db::getInstance();
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Post(
                $row['id'],
                $row['title'],
                $row['content'],
                $row['author_id'],
                $row['created_at']
            );
        }

        return null;
    }

    public static function update($id, $title, $content)
    {
        $pdo = Db::getInstance();
        $sql = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $content, $id]);
    }

    public static function delete($id)
    {
        $pdo = Db::getInstance();
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
