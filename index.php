 <?php

use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;
use gestionclub\Models\PlanInscription;
use gestionclub\DAO\PlanInscriptionDAO;
use gestionclub\Models\Inscription;
use gestionclub\DAO\InscriptionDAO;

require __DIR__."/vendor/autoload.php";

//create
//$membre1=new Membre("ayoub","adil","06 rue intamim 01","azizmbu@gmail.com","0616815066");
 ///$membre= MembreDao::getMembreById(5);
//echo $membre;
//delete
//$planInscription= new PlanInscription("ultimate","acces a tous les services",4000);
//PlanInscriptionDAO::createPlanInscription($planInscription);
///$planInscription= PlanInscriptionDAO::getPlanInscriptionById(1);



//update planInscription
/*
$planInscription= new PlanInscription("ultimate","acces a tous les services",4500);
$planInscription->setidPlanInscription(1);
PlanInscriptionDAO::updatePlanInscription($planInscription);
*/

//create inscription
/*
$membre= MembreDao::getMembreById(5);
$planInscription= PlanInscriptionDAO::getPlanInscriptionById(1);
$inscription= new Inscription($membre,$planInscription,date("Y/m/d"));
InscriptionDAO::createInscription($inscription);
*/

//get inscription
//$inscription = new Inscription($membre,$planInscription,date("Y/m/d"));
//echo InscriptionDAO::getInscriptionById(2);
//echo $inscription;


//update inscription
/*
$inscription= InscriptionDAO::getInscriptionById(2);
$inscription->setEtat("Verifiée");
InscriptionDAO::updateInscription($inscription);
$inscription= InscriptionDAO::getInscriptionById(2);
echo $inscription;
*/

//delete inscription
//InscriptionDAO::deleteInscription(2);


?>