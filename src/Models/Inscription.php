<?php

namespace gestionclub\Models;
use JsonSerializable;

// $membre=MEmbreDAO:: getMembreById($id_membre);

// ["nomMembre": ]

class Inscription implements JsonSerializable
{
    private $id_inscription;
    private  $id_membre;
    private $id_plan_inscription;
    private $date_inscription;
    private $etat=" En attente";

    // Constructor
    public function __construct( $id_membre, $id_plan_inscription) {
        $this->id_membre = $id_membre;
        $this->id_plan_inscription = $id_plan_inscription;
        $this->date_inscription = date("Y-m-d");
    }

    // Getters
    public function getIdInscription() {
        return $this->id_inscription;
    }

    public function getIdMembre() {
        return $this->id_membre;
    }

    public function getIdPlanInscription() {
        return $this->id_plan_inscription;
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

    public function setIdMembre($id_membre) {
        $this->id_membre = $id_membre;
    }

    public function setIdPlanInscription($id_plan_inscription) {
        $this->id_plan_inscription = $id_plan_inscription;
    }

    public function setDateInscription($date_inscription) {
        $this->date_inscription = $date_inscription;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function __toString(){
        return "$this->id_inscription \n
        $this->id_membre \n
        $this->id_plan_inscription \n
        $this->date_inscription \n
        $this->etat";
    }

    public function jsonSerialize()
    {
        return [
            "id_inscription" => $this->id_inscription,
            'id_membre' => $this->id_membre,
            "id_plan_inscription" => $this->id_plan_inscription,
            "etat" => $this->etat
        ];
    }

   
}

