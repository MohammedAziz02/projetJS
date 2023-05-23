<?php

use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;
use gestionclub\DAO\InscriptionDao;
use gestionclub\Models\inscription;
use gestionclub\DAO\PlanInscriptionDao;
use gestionclub\Models\PlanInscription;

require __DIR__. "/../../vendor/autoload.php";

$id = isset($_POST['id']) ? $_POST['id'] : NULL;
$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : NULL;
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : NULL;
$motdepasse = isset($_POST['motdepasse']) ? $_POST['motdepasse'] : NULL;


$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$type = isset($_POST['type']) ? $_POST['type'] : NULL;
$search = isset($_POST['search']) ? $_POST['search'] : NULL;

//somme entre deux dates
$date1 = isset($_POST['date1']) ? $_POST['date1'] : NULL;
$date2 = isset($_POST['date2']) ? $_POST['date2'] : NULL;

$idMembre = isset($_POST['idMembre']) ? $_POST['idMembre'] : NULL;





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
}else if($action=='modifierProfil'){
    $membre=MembreDAO::getMembreById($id);
    echo $membre;
    $membre->setnom($nom);
    $membre->setprenom($prenom);
    $membre->setemail($email);
    $membre->settelephone($telephone);
    $membre->setadresse($adresse);
    $membre->setpassword($motdepasse);
    //echo "\n".$membre;

    MembreDAO::updateMembre($membre);
    //echo "\n".$membre=MembreDAO::getMembreById($id);
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
        // $inscription=InscriptionDAO::getInscriptionByAll($search);
        $inscription=InscriptionDAO::getInscriptionByAllJointure($search);
        echo json_encode($inscription);
    } if($type=='mesPlansInscriptions'){
        $inscriptions=InscriptionDAO::getInscriptionByMembreandPlanInscriptionJoinForSearch($idMembre,$search);
        echo json_encode($inscriptions);
    }
}else if($action=='sommeGain'){
    echo InscriptionDAO::getSumBetweenTwoDates($date1,$date2);
}
