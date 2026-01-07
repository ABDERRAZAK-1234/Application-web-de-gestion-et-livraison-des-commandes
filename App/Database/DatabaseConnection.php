<?php
namespace App\Database;
use PDO;
use PDOException;

class DatabaseConnection
{
    private static ?PDO $conn = null;

    // constructor privé
    private function __construct() {}

    public static function connexion(): PDO
    {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=localhost;dbname=livraison;charset=utf8",
                    "root",
                    ""
                );
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "success";
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
// DatabaseConnection::connexion();