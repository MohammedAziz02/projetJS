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
require __DIR__ . "/../../vendor/autoload.php";


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

    //
    public static function getInscriptionByAll($word){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM inscription WHERE id_membre like ? or id_planInscription like ? 
            or date_inscription like ? 
            or etat like ?  ";
            $stmt = self::$db->prepare($query);
            $stmt->execute(["%".$word."%","%".$word."%","%".$word."%","%".$word."%"]);
            $inscriptions=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                if ($result) {
                    $membre=MembreDAO::getMembreById($result['id_Membre']);
                    $planInscription=PlanInscriptionDAO::getPlanInscriptionById($result['id_planInscription']);
                    $inscription = new Inscription(
                        $membre,
                        $planInscription,
                        $result['date_inscription'],
                        $result['etat']
                    );
                    $inscription->setIdInscription($result["id_Inscription"]);

                    array_push($inscriptions,$inscription);
                } 
            }
            return $inscriptions;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
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


    public static function getAllInscriptionWithJointureMembreAndPlanInscription(){

        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * from inscription i INNER JOIN membre m on i.id_Membre=m.id_membre INNER JOIN planinscription p on p.idPlanInscription=i.id_planInscription";
            $stmt = self::$db->prepare($query);
            $stmt->execute();

            $planinscriptions=array();

            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                 if ($result) {
                   array_push($planinscriptions,$result); } 
                }
            return $planinscriptions;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    
    }

    public static function confirmInscriptionforamember($id){
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "UPDATE Inscription SET etat = ? WHERE id_Inscription = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([
                "confirmé",
                $id
            ]);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }



    public static function getInscriptionByAllJointure($word){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * from inscription i INNER JOIN membre m on i.id_Membre=m.id_membre INNER JOIN planinscription p on p.idPlanInscription=i.id_planInscription
            WHERE i.id_membre like ? or i.id_planInscription like ? or i.id_Inscription like ? or i.date_inscription like ? or i.etat  like ? or m.nom like ? or m.prenom like ? or m.email like ? or m.telephone like ? or m.adresse like ?
             or p.nomPlanInscription like ? or p.description like ? or p.prix like ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute(["%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%","%".$word."%"]);
            $data=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

                if ($result) {
                    array_push($data,$result);
                } 
            }
            return $data;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }


}
