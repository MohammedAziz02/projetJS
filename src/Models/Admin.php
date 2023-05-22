<?php

namespace gestionclub\Models;
class Admin {
    private $idAdmin;
    private $username;
    private $email;
    private $password;

    public function __construct($id,$username,$email,$password){
        $this->idAdmin=$id;
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
    }

    // Getters
    public function getId() {
        return $this->idAdmin;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getNom() {
        return $this->username;
    }

    public function getPrenom() {
        return "";
    }




    
    public function getEmail(){
        return $this->email;
    }

    public function getpassword() {
        return $this->password;
    }


    // Setters
    public function setId($id) {
        $this->idAdmin = $id;
    }

    
    public function setUsername($username) {
        $this->username = $username;
    }
    

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setpassword($password) {
        $this->password = $password;
    }

    // toString method
    public function __toString() {
        return "idAdmin: " . $this->idAdmin . "\n" .
               "Username: " . $this->username . "\n" .
               "email: " . $this->email . "\n" .
               "password: " . $this->password . "\n" ;
    }
}

?>