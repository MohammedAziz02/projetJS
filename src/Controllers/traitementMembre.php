<?php

use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;

require __DIR__. "/../../vendor/autoload.php";


$nom = isset($_POST['nom']) ? $_POST['nom'] : NULL;
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$DOfbirth = isset($_POST['DOfbirth']) ? $_POST['DOfbirth'] : NULL;
$filiere = isset($_POST['filiere']) ? $_POST['filiere'] : NULL;

$action = isset($_POST['action']) ? $_POST['action'] : NULL;

$id = isset($_POST['id']) ? $_POST['id'] : NULL;

if($action=='afficherTous'){
    $membres=MembreDAO::getMembreByAll("");
    echo json_encode($membres);
}
else if($action=='supprimer'){
    $membres=MembreDAO::deleteMembreById($id);
    echo json_encode($membres);
}


?>