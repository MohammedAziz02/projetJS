<?php

use gestionclub\DAO\PlanInscriptionDAO;
use gestionclub\Models\PlanInscription;

require __DIR__ . "/../../vendor/autoload.php";

$nomplan = isset($_POST["nomplan"]) ? $_POST["nomplan"] : NULL;
$descriptionplan = isset($_POST["descriptionplan"]) ? $_POST["descriptionplan"] : NULL;
$prixplan = isset($_POST["prixplan"]) ? $_POST["prixplan"] : NULL;
$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$id = isset($_POST['id']) ? $_POST['id'] : NULL;

if ($action == "ajouterplaninscription") {
    $planinscription = new PlanInscription($nomplan, $descriptionplan, $prixplan);
    PlanInscriptionDAO::createPlanInscription($planinscription);
} elseif ($action == "afficherTous") {
    $plansInscriptions = PlanInscriptionDAO::getPlanInscriptionByAll("");
    echo json_encode($plansInscriptions);
} elseif ($action == "modifierplan") {
    
    $planinscription = PlanInscriptionDAO::getPlanInscriptionById($id);
    $planinscription->setDescription($descriptionplan);
    $planinscription->setPrix($prixplan);
    $planinscription->setNom($nomplan);
    PlanInscriptionDAO::updatePlanInscription($planinscription);

    echo "success";
}
elseif($action=="supprimer"){
    echo "dkhl ";
    PlanInscriptionDAO::deletePlanInscription($id);
    echo "success";
}else if($action=='afficherSelonId'){

}
