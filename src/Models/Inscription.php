<?php

namespace gestionclub\Models;


class Inscription {
    private $id_inscription;
    private Membre $membre;
    private PlanInscription $plan_inscription;
    private $date_inscription;
    private $etat=" En attente";

    // Constructor
    public function __construct( $membre, $plan_inscription, $date_inscription) {
        
        $this->membre = $membre;
        $this->plan_inscription = $plan_inscription;
        $this->date_inscription = $date_inscription;
    }

    // Getters
    public function getIdInscription() {
        return $this->id_inscription;
    }

    public function getMembre() {
        return $this->membre;
    }

    public function getPlanInscription() {
        return $this->plan_inscription;
    }

    public function getDateInscription() {
        return $this->date_inscription;
    }

    public function getEtat() {
        return $this->etat;
    }

    // Setters
    public function setIdInscription($id_inscription) {
        $this->id_inscription = $id_inscription;
    }

    public function setMembre($membre) {
        $this->membre = $membre;
    }

    public function setPlanInscription($plan_inscription) {
        $this->plan_inscription = $plan_inscription;
    }

    public function setDateInscription($date_inscription) {
        $this->date_inscription = $date_inscription;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function __toString(){
        return "$this->id_inscription \n
        $this->membre \n
        $this->plan_inscription \n
        $this->date_inscription \n
        $this->etat";
    }

   
}

