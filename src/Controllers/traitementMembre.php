<?php

use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;
use gestionclub\DAO\InscriptionDAO;
use gestionclub\DAO\PlanInscriptionDAO;

require __DIR__. "/../../vendor/autoload.php";

$id = isset($_POST['id']) ? $_POST['id'] : NULL;
$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : NULL;
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : NULL;

$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$type = isset($_POST['type']) ? $_POST['type'] : NULL;
$search = isset($_POST['search']) ? $_POST['search'] : NULL;



if($action=='afficherTous'){
    $membres=MembreDAO::getMembreByAll("");
    echo json_encode($membres);
}
else if($action=='supprimer'){
    $membres=MembreDAO::deleteMembre( $id);
    // echo json_encode($membres);
}
else if($action=='modifier'){
    $membre=MembreDAO::getMembreById($id);
    echo $membre;
    $membre->setnom($nom);
    $membre->setprenom($prenom);
    $membre->setemail($email);
    $membre->settelephone($telephone);
    $membre->setadresse($adresse);
    echo "\n".$membre;

    echo MembreDAO::updateMembre($membre);
    echo "\n".$membre=MembreDAO::getMembreById($id);
    //$membres=MembreDAO::getMembreByAll("");
    //echo json_encode($membres);
    echo "success";
}
else if($action=='search'){
    
    if($type=='membre'){
        $membres=MembreDAO::getMembreByAll($search);
        echo json_encode($membres);

    }else if($type=='planInscription'){
        $planInscription=PlanInscriptionDAO::getPlanInscriptionByAll($search);
        echo json_encode($planInscription);
    }else if($type=='inscription'){
        $inscription=InscriptionDAO::getInscriptionByAll($search);
        echo json_encode($inscription);
    }
}