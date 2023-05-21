<?php


namespace gestionclub\Models;

use JsonSerializable;



class PlanInscription implements JsonSerializable
{
    private $idPlanInscription;
    private $nom;
    private $description;
    private $prix;

    // Constructor
    public function __construct($nom, $description, $prix)
    {

        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
    }

    // Getters
    public function getidPlanInscription()
    {
        return $this->idPlanInscription;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    // Setters
    public function setidPlanInscription($idPlanInscription)
    {
        $this->idPlanInscription = $idPlanInscription;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function __toString()
    {
        return "PlanInscription[idPlanInscription={$this->idPlanInscription}, nom={$this->nom}, description={$this->description}, prix={$this->prix}]";
    }

    public function jsonSerialize()
    {
        return [
            'idPlanInscription' => $this->idPlanInscription,
            "nom" => $this->nom,
            "description" => $this->description,
            "prix" => $this->prix,
            ];
    }
   
}
