<?php

class Db
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=127.0.0.1;port=8889;dbname=social_network", "root", "root");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Correction ici
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}