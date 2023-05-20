<?php

use gestionclub\Models\Membre;
use gestionclub\DAO\MembreDAO;
require "./vendor/autoload.php";

$users=MembreDAO::getMembreByAll("");
foreach($users as $user)
    echo $user."\n";

?>