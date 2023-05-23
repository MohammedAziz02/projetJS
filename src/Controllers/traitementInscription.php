<?php

use gestionclub\DAO\InscriptionDAO;
use gestionclub\Models\Inscription;
use gestionclub\DAO\PlanInscriptionDAO;
use gestionclub\Models\PlanInscription;

require __DIR__ . "/../../vendor/autoload.php";

$idMembre = isset($_POST["idMembre"]) ? $_POST["idMembre"] : NULL;
$idPlanInscription = isset($_POST["idPlanInscription"]) ? $_POST["idPlanInscription"] : NULL;
$idInscription = isset($_POST["idInscription"]) ? $_POST["idInscription"] : NULL;
$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$id = isset($_POST['id']) ? $_POST['id'] : NULL;

if ($action == "ajouterInscription") {
    $inscription = new Inscription($idMembre, $idPlanInscription);
    echo InscriptionDAO::createInscription($inscription);   
    //echo "success";
} elseif ($action == "afficherTous") {
    $inscriptions = PlanInscriptionDAO::getPlanInscriptionByAll("");
    echo json_encode($inscriptions);
}elseif ($action == "afficherMesPlans") {
    $inscriptions = InscriptionDAO::getInscriptionByMembreandPlanInscriptionJoin($idMembre);
    echo json_encode($inscriptions);
} elseif ($action == "supprimerInscription") {
    InscriptionDAO::deleteInscription($idInscription);
    $inscriptions = InscriptionDAO::getInscriptionByMembreandPlanInscriptionJoin($idMembre);
    echo json_encode($inscriptions);

} 
//print_r(InscriptionDAO::getInscriptionByMembreandPlanInscriptionJoin(38));
