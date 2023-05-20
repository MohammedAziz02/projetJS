<?php

namespace gestionclub\DAO;

use PDO;
use PDOException;

use gestionclub\Models\Inscription;
use gestionclub\Helpers\DatabaseConnection;
use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;
use gestionclub\Models\PlanInscription;
use gestionclub\DAO\PlanInscriptionDAO;
// require __DIR__ . "/../../vendor/autoload.php";


class InscriptionDAO {
    private static $db;

    private static function initialize() {
        self::$db = DatabaseConnection::getInstance()->getConnection();
    }

    // Static method to create a new member
    public static function createInscription(Inscription $Inscription) {
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }   

         $query = "INSERT INTO Inscription (id_Membre, id_planInscription,date_inscription,etat) 
         VALUES (?, ?, ?,? )";

            $stmt = self::$db->prepare($query);

            $stmt->execute([
                $Inscription->getMembre()->getid_membre(),
                $Inscription->getPlanInscription()->getidPlanInscription(),
                $Inscription->getDateInscription(),
                $Inscription->getEtat()
            ]);
            
            return self::$db->lastInsertId();
        } catch (PDOException $e) {
            //echo $e->getMessage();
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to retrieve a member by ID
    public static function getInscriptionById($id) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM Inscription WHERE id_Inscription = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                
                $Inscription = new Inscription(
                    MembreDAO::getMembreById($result['id_Membre']),
                    PlanInscriptionDAO::getPlanInscriptionById($result['id_planInscription']),
                    $result['date_inscription']
                );
                $Inscription->setidInscription($id);
                $Inscription->setEtat($result['etat']);
                return $Inscription;
                echo "here";
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return null;
        }
    }

    // Static method to update a member
    public static function updateInscription(Inscription $inscription) {
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "UPDATE Inscription SET id_Membre= ?, id_PlanInscription = ?, etat = ? WHERE id_Inscription = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $inscription->getMembre()->getid_membre(),
                $inscription->getPlanInscription()->getidPlanInscription(),
                $inscription->getEtat(),
                $inscription->getidInscription()
            ]);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to delete a member
    public static function deleteInscription($id) {
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "DELETE FROM Inscription WHERE id_Inscription = ?";
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