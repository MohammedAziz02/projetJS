<?php

namespace gestionclub\Models;
class Membre {
    private $id_membre;
    private $nom;
    private $prenom;
    private $adresse;
    private $email;
    private $telephone;
    
    private $liste_Planinsription=[];
    // Constructor
    public function __construct($nom, $prenom, $adresse, $email, $telephone) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    // Getters
    public function getid_membre() {
        return $this->id_membre;
    }

    public function getnom() {
        return $this->nom;
    }

    public function getprenom() {
        return $this->prenom;
    }

    public function getadresse() {
        return $this->adresse;
    }

    public function getemail() {
        return $this->email;
    }

    public function gettelephone() {
        return $this->telephone;
    }

    // Setters
    public function setid_membre($id_membre) {
        $this->id_membre = $id_membre;
    }

    public function setnom($nom) {
        $this->nom = $nom;
    }

    public function setprenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setadresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setemail($email) {
        $this->email = $email;
    }

    public function settelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function addtoListPlanInscription($x){
        array_push($this->liste_Planinsription,$x);
    }


    public function getListInscription(){
        return $this->liste_Planinsription;
    }

    // toString method
    public function __toString() {
        return "id_membre: " . $this->id_membre . "\n" .
               "nom: " . $this->nom . "\n" .
               "prenom: " . $this->prenom . "\n" .
               "adresse: " . $this->adresse . "\n" .
               "email: " . $this->email . "\n" .
               "telephone: " . $this->telephone . "\n";
    }
}

?>