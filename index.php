<?php
use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;
use gestionclub\Models\PlanInscription;

require "./vendor/autoload.php";


$membre1=new Membre("aziz","Mohammed","06 rue intamim 01","azizmbu@gmail.com","0616815066");
$planinscription1=new PlanInscription("planinsci1","inscription 1",100);
$planinscription2=new PlanInscription("planinsci1","inscription 1",200);
$membre1->addtoListPlanInscription($planinscription1);
$membre1->addtoListPlanInscription($planinscription2);



print_r($membre1->getListInscription());

echo $membre1;

// MembreDao::createMembre($a);

// MembreDao::deleteMembre(1);





?>