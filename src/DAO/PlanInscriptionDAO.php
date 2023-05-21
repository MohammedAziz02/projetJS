<?php

namespace gestionclub\DAO;

use PDO;
use PDOException;

use gestionclub\Models\PlanInscription;
use gestionclub\Helpers\DatabaseConnection;

// require __DIR__ . "/../../vendor/autoload.php";


class PlanInscriptionDAO {
    private static $db;

    private static function initialize() {
        self::$db = DatabaseConnection::getInstance()->getConnection();
    }

    // Static method to create a new member
    public static function createPlanInscription(PlanInscription $planInscription) {
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }   

         $query = "INSERT INTO PlanInscription (nomPlanInscription, description , prix) 
         VALUES (?, ?, ?)";

            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $planInscription->getNom(),
                $planInscription->getDescription(),
                $planInscription->getPrix()
            ]);

            return self::$db->lastInsertId();
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to retrieve a member by ID
    public static function getPlanInscriptionById($id) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM planInscription WHERE idPlanInscription = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$id]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $planInscription = new PlanInscription(
                    $result['nomPlanInscription'],
                    $result['description'],
                    $result['prix']
                );
                $planInscription->setidPlanInscription($id);
                return $planInscription;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return null;
        }
    }

    //

    public static function getPlanInscriptionByAll($word){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM planInscription WHERE nomPlanInscription like ? 
            or description like ?
            or prix like ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute(["%".$word."%","%".$word."%","%".$word."%",]);
            $planInscriptions=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                if ($result) {
                    $planInscription = new PlanInscription(
                        $result['nomPlanInscription'],
                        $result['description'],
                        $result['prix']
                    );
                    $planInscription->setidPlanInscription($result["idPlanInscription"]);

                    array_push($planInscriptions,$planInscription);
                } 
            }
            return $planInscriptions;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    // Static method to update a member
    public static function updatePlanInscription(PlanInscription $planInscription) {
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "UPDATE PlanInscription SET nomPlanInscription = ?, description = ?, prix = ? WHERE idPlanInscription = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([
                $planInscription->getNom(),
                $planInscription->getDescription(),
                $planInscription->getPrix(),
                $planInscription->getidPlanInscription()
            ]);

            return true;
        } catch (PDOException $e) {
            // Handle any errors or exceptions
            return false;
        }
    }

    // Static method to delete a member
    public static function deletePlanInscription($id) {
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "DELETE FROM PlanInscription WHERE idPlanInscription = ?";
            $stmt = self::$db->prepare($query);

            $stmt->execute([$id]);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
