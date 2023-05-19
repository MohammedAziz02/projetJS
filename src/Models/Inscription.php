<?php

namespace gestionclub\Models;

use DateTime;

class Inscription {
    private $id_inscription;
    private Membre $membre;
    private PlanInscription $plan_inscription;
    private DateTime $date_inscription;
    private $etat;

    // Constructor
    public function __construct($id_inscription, $membre, $plan_inscription, $date_inscription, $etat) {
        $this->id_inscription = $id_inscription;
        $this->membre = $membre;
        $this->plan_inscription = $plan_inscription;
        $this->date_inscription = $date_inscription;
        $this->etat = $etat;
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

   
}

