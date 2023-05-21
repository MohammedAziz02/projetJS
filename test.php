<?php

use gestionclub\Models\Membre;
use gestionclub\DAO\MembreDAO;
use gestionclub\Models\Inscription;
use gestionclub\DAO\InscriptionDAO;
use gestionclub\Models\PlanInscription;
    use gestionclub\DAO\PlanInscriptionDAO;
require "./vendor/autoload.php";

    $users=MembreDAO::getMembreByAll("");
    print_r($users);
foreach($users as $user)
    echo $user."\n";


/*
$inscriptions=InscriptionDAO::getInscriptionByAll("");
foreach ($inscriptions as $inscription) {
    echo $inscription;
}
*/
/*
$planInscriptions= PlanInscriptionDAO::getPlanInscriptionByAll("");
foreach($planInscriptions as $planInscription)
    echo $planInscription;
*/
?>