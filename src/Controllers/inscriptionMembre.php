<?php

require __DIR__. "/../../vendor/autoload.php";
use gestionclub\DAO\MembreDao;
use gestionclub\Models\Membre;
// commencer la session
session_start();



// obtenir les données du formulaire
$nom=isset($_POST["nom"])?$_POST["nom"]:"";
$prenom=isset($_POST["prenom"])?$_POST["prenom"]:"";
$email=isset($_POST["email"])?$_POST["email"]:"";
$adresse=isset($_POST["adresse"])?$_POST["adresse"]:"";
$motdepasse=isset($_POST["motdepasse"])?$_POST["motdepasse"]:"";
$telephone=isset($_POST["telephone"])?$_POST["telephone"]:"";
$motdepasse=isset($_POST["motdepasse"])?$_POST["motdepasse"]:"";

// test que les données recevées non pas vide
if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($adresse) && !empty($telephone) && !empty($motdepasse)){

    // créer alors un membre
    $membre=new Membre($nom,$prenom,$adresse,$email,$telephone,$motdepasse);
    // ajouter dans la base de données
    MembreDao::createMembre($membre);
    // redirection vers la page d'inscription

    
    header("Location:../Views/connexion.php");
}else{
    // sinon on le transfère vers la page d'inscription
    header("Location:../Views/inscription.php");
}



