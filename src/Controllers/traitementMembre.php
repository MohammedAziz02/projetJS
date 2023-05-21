<?php

use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;

require __DIR__. "/../../vendor/autoload.php";

$id = isset($_POST['id']) ? $_POST['id'] : NULL;
$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : NULL;
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : NULL;

$action = isset($_POST['action']) ? $_POST['action'] : NULL;



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
