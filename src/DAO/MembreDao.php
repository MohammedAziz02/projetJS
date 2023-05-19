<?php

namespace gestionclub\DAO;

use PDO;
use PDOException;

use gestionclub\Models\Membre;
use gestionclub\Helpers\DatabaseConnection;

// require __DIR__ . "/../../vendor/autoload.php";


class MembreDao {
    private static $db;

    private static function initialize() {
        self::$db = DatabaseConnection::getInstance()->getConnection();
    }

    // Static method to create a new member
    public static function createMembre(Membre $membre) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }

         $query = "INSERT INTO membre (nom, prenom, adresse, email, telephone) 
                      VALUES (?, ?, ?, ?, ?)";

                      

            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getAdresse(),
                $membre->getEmail(),
                $membre->getTelephone()
            ]);

            return self::$db->lastInsertId();
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to retrieve a member by ID
    public static function getMembreById($id) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM membre WHERE id_membre = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $membre = new Membre(
                    $result['Nom'],
                    $result['Prénom'],
                    $result['Adresse'],
                    $result['Email'],
                    $result['Téléphone']
                );

                return $membre;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return null;
        }
    }

    // Static method to update a member
    public static function updateMembre(Membre $membre) {
        try {
            $query = "UPDATE membre SET nom = ?, prenom = ?, adresse = ?, email = ?, telephone = ? WHERE id_membre = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getAdresse(),
                $membre->getEmail(),
                $membre->getTelephone(),
                $membre->getid_membre()
            ]);

            return true;
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to delete a member
    public static function deleteMembre($id) {
        try {
            $query = "DELETE FROM membre WHERE id_membre = ?";
            $stmt = self::$db->prepare($query);

            $stmt->execute([$id]);

            return true;
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return false;
        }
    }
}


?>