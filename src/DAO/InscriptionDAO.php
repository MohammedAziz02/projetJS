<?php

namespace gestionclub\DAO;

use PDO;
use PDOException;

use gestionclub\Models\Inscription;
use gestionclub\Helpers\DatabaseConnection;


 require __DIR__ . "/../../vendor/autoload.php";



class InscriptionDAO {
    private static $db;

    private static function initialize() {
        self::$db = DatabaseConnection::getInstance()->getConnection();
    }

    // Static method to create a new member
    public static function createInscription(Inscription $Inscription) {
        if(InscriptionDAO::isAlreadyChose($Inscription)==0){
            try {
                if (!isset(self::$db)) {
                    self::initialize();
                }   
            
             $query = "INSERT INTO Inscription (id_Membre, id_planInscription,date_inscription,etat) 
             VALUES (?, ?, ?,? )";
    
                $stmt = self::$db->prepare($query);
    
                $stmt->execute([
                    $Inscription->getidmembre(),
                    $Inscription->getidPlanInscription(),
                    $Inscription->getDateInscription(),
                    $Inscription->getEtat()
                ]);
                
                return "success";
            } catch (PDOException $e) {
                echo $e->getMessage();
                // Handle any errors or exceptions
                return false;
            } 
        }else return "failed";
        
        
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
                    $result['id_Membre'],
                    $result['id_planInscription']
                );
                $Inscription->setidInscription($id);
                $Inscription->setEtat($result['etat']);
                return $Inscription;
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
                    $inscription = new Inscription(
                        $result['id_Membre'],
                        $result['id_planInscription']
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

    //
    public static function getInscriptionByMembre($idMembre){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM Inscription WHERE id_Membre = ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$idMembre]);

            $inscriptions=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                if ($result) {
                
                    $Inscription = new Inscription(
                        $result['id_Membre'],
                        $result['id_planInscription']
                    );
                    $Inscription->setidInscription($result['id_Inscription']);
                    $Inscription->setEtat($result['etat']);
                    $Inscription->setDateInscription($result['date_inscription']);
                    array_push($inscriptions, $Inscription);
                } 
            }
            return $inscriptions; 
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return null;
        }
    }
    public static function getInscriptionByMembreandPlanInscriptionJoin($idMembre){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM Inscription I inner join PlanInscription P 
            on P.idPlanInscription= I.id_planInscription inner join Membre M
            on M.id_membre=I.id_Membre where M.id_membre= ?";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$idMembre]);

            $objects=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                if ($result) {
                    $object=["id_Inscription"=>$result['id_Inscription'],
                    "nomPlanInscription"=>$result['nomPlanInscription'],
                    "description"=>$result['description'],
                    "dateInscription"=>$result['date_inscription'],
                    "etat"=>$result['etat']
                    ];
                    array_push($objects, $object);
                } 
            }
            //print_r($objects);
            return $objects; 
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return null;
        }
    }

    public static function getInscriptionByMembreandPlanInscriptionJoinForSearch($idMembre,$search){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT * FROM Inscription I inner join PlanInscription P 
            on P.idPlanInscription= I.id_planInscription inner join Membre M
            on M.id_membre=I.id_Membre where M.id_membre= ? and 
            ( P.nomPlanInscription like ? or P.prix like ? 
            or P.description like ? or
            I.etat like ? or I.date_inscription like ? ); ";
            $stmt = self::$db->prepare($query);
            $stmt->execute([$idMembre,"%".$search."%","%".$search."%",
            "%".$search."%","%".$search."%","%".$search."%"]);
            // SELECT * FROM Inscription I inner join PlanInscription P 
            // on P.idPlanInscription= I.id_planInscription inner join Membre M
            // on M.id_membre=I.id_Membre where M.id_membre= 38 and (P.prix like '%1%' or P.nomPlanInscription like '%ten%');
            $objects=array();
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                if ($result) {
                    $object=["id_Inscription"=>$result['id_Inscription'],
                    "nomPlanInscription"=>$result['nomPlanInscription'],
                    "description"=>$result['description'],
                    "dateInscription"=>$result['date_inscription'],
                    "etat"=>$result['etat']
                    ];
                    array_push($objects, $object);
                } 
            }
            //print_r($objects);
            return $objects; 
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return null;
        }
    }

    public static function getSumBetweenTwoDates($date1,$date2){
        try {

            if (!isset(self::$db)) {
                self::initialize();
            }
            $query = "SELECT sum(P.prix) as 'somme' from inscription I 
            inner join planinscription P on P.idPlanInscription=I.id_planInscription
             where I.etat=? and I.date_inscription BETWEEN ? and ? ;
            ";
            $stmt = self::$db->prepare($query);
            $stmt->execute(["confirmé",$date1,$date2]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($result) {
                return $result['somme'] ;
            } else {
                return -1;
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
                $inscription->getidmembre(),
                $inscription->getidPlanInscription(),
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

      // To test if a member already chose a planInscription
      public static function isAlreadyChose(Inscription $Inscription){
        try {
            if (!isset(self::$db)) {
                self::initialize();
            }   

         $query = "SELECT count(*) as res from inscription where id_Membre= ? 
         and id_planInscription = ?";

            $stmt = self::$db->prepare($query);

            $stmt->execute([
                $Inscription->getidmembre(),
                $Inscription->getidPlanInscription()
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result){
                return $result['res'];
            } 
        } catch (PDOException $e) {
            echo $e->getMessage();
            // Handle any errors or exceptions
            return false;
        }
    }

}
  

//print_r(InscriptionDAO::getInscriptionByMembreandPlanInscriptionJoin(38));
//echo InscriptionDAO::getSumBetweenTwoDates("2023-05-20","2023-05-23");
//print_r(InscriptionDAO::getInscriptionByMembreandPlanInscriptionJoinForSearch(38,"tenn"));

//$inscription= new Inscription(38,14);
//echo InscriptionDAO::isAlreadyChose($inscription);

?>
