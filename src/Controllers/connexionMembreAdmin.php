<?php

use gestionclub\DAO\MembreDao;

require __DIR__ . "/../../vendor/autoload.php";

session_start();




if (empty($_POST["email"]) || empty($_POST["motdepasse"])) {
    $_SESSION["message"] = "veuillez remplir tous les champs";
    header("Location:../Views/connexion.php");
} else {

    $membre = MembreDao::getMembreByEmail($_POST["email"]);

    echo $membre;

    if ($membre != null) {
        if ($membre->getpassword() == $_POST["motdepasse"]) {
            $_SESSION["user"] = $membre;
        } else {
            $_SESSION["message"] = "Mot de passe incorrect";
            header("Location:../Views/connexion.php");
        }
    } else {
        $_SESSION["message"] = "Mot de passe ou email  incorrect";
        header("Location:../Views/connexion.php");
    }
}
