<?php

use gestionclub\DAO\InscriptionDAO;

$action = isset($_POST['action']) ? $_POST['action'] : NULL;
$type = isset($_POST['type']) ? $_POST['type'] : NULL;
$search = isset($_POST['search']) ? $_POST['search'] : NULL;
$id_Inscription = isset($_POST['id']) ? $_POST['id'] : NULL;

require __DIR__. "/../../vendor/autoload.php";

if($action=="affichertouslesinscriptions"){
    $data=InscriptionDAO::getAllInscriptionWithJointureMembreAndPlanInscription();
    echo json_encode($data);
}
elseif($action=='confirmerInscription'){
    InscriptionDAO::confirmInscriptionforamember($id_Inscription);
    echo "succcesss";
}

?>