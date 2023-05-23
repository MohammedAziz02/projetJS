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

         $query = "INSERT INTO membre (nom, prenom, adresse, email, telephone,password) 
         VALUES (?, ?, ?, ?, ?,?)";

                      

            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getAdresse(),
                $membre->getEmail(),
                $membre->getTelephone(),
                $membre->getpassword()
            ]);

            return self::$db->lastInsertId();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
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
                    $result['nom'],
                    $result['prenom'],
                    $result['adresse'],
                    $result['email'],
                    $result['telephone'],
                    $result["password"]
                );
                $membre->setid_membre($id);

                return $membre;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "error";
            // Handle any errors or exceptions
            return null;
        }
    }

    public static function getMembreByEmail($email) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM membre WHERE email = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $membre = new Membre(
                    $result['nom'],
                    $result['prenom'],
                    $result['adresse'],
                    $result['email'],
                    $result['telephone'],
                    $result["password"]
                );
                $membre->setid_membre($result["id_membre"]);
                return $membre;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public static function getMembreByAll($word){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM membre WHERE nom like ? or prenom like ? or adresse like ? 
            or email like ? or telephone like ? ";
            $stmt = self::$db->prepare($query);
            $stmt->execute(["%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%"]);
            $membres=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                if ($result) {
                    $membre = new Membre(
                        $result['nom'],
                        $result['prenom'],
                        $result['adresse'],
                        $result['email'],
                        $result['telephone'],
                        $result["password"]
                    );
                    $membre->setid_membre($result["id_membre"]);

                    array_push($membres,$membre);
                } 
            }
            return $membres;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }



    // Static method to update a member
    public static function updateMembre(Membre $membre) {
        try {
            $query = "UPDATE membre SET nom = ?, prenom = ?, adresse = ?,
             email = ?, telephone = ?  , password = ? WHERE id_membre = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $membre->getNom(),
                $membre->getPrenom(),
                $membre->getAdresse(),
                $membre->getEmail(),
                $membre->getTelephone(),
                $membre->getpassword(),
                $membre->getid_membre()
                
            ]);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to delete a member
    public static function deleteMembre($id) {
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }
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