<?php

use gestionclub\DAO\InscriptionDAO;
use gestionclub\Models\Inscription;
use gestionclub\DAO\PlanInscriptionDAO;
require __DIR__ . "/../../vendor/autoload.php";

$idMembre = isset($_POST["idMembre"]) ? $_POST["idMembre"] : NULL;
$idPlanInscription = isset($_POST["idPlanInscription"]) ? $_POST["idPlanInscription"] : NULL;
$idInscription = isset($_POST["idInscription"]) ? $_POST["idInscription"] : NULL;
$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$id = isset($_POST['id']) ? $_POST['id'] : NULL;
$type = isset($_POST['type']) ? $_POST['type'] : NULL;
$search = isset($_POST['search']) ? $_POST['search'] : NULL;
$id_Inscription = isset($_POST['id']) ? $_POST['id'] : NULL;

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

} elseif($action=="affichertouslesinscriptions"){
    $data=InscriptionDAO::getAllInscriptionWithJointureMembreAndPlanInscription();
    echo json_encode($data);
}elseif($action=='confirmerInscription'){
    InscriptionDAO::confirmInscriptionforamember($id_Inscription);
    echo "succcesss";
}
