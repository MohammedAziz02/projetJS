<?php
// // Perform necessary data retrieval from your server/database
// // Fetch data, generate the HTML table, and return it
// $tableData = '<table>';
// // Add table headers
// $tableData .= '<tr><th>Column 1</th><th>Column 2</th><th>Column 3</th></tr>';

// // Retrieve and add table rows with actual data from your server
// // Example data
// $tableData .= '<tr><td>Data 1</td><td>Data 2</td><td>Data 3</td></tr>';
// $tableData .= '<tr><td>Data 4</td><td>Data 5</td><td>Data 6</td></tr>';

// $tableData .= '</table>';

// echo $tableData;

use gestionclub\DAO\MembreDao;

require __DIR__. "/../../vendor/autoload.php";

if(isset($_POST["action"])){
    if($_POST["action"]=="afficherTousmembres"){
        $members=MembreDao::getMembreByAll("");
        // print_r( type $members);
        $json=json_encode($members);
        echo $json;
    }
}





// // Generate the table
// $tableData = '<table class="table table-striped">';
// $tableData .= '<thead class="thead-dark"><tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Adresse</th><th>email</th><th>telephone</th><th colspan="2">Action</th></tr></thead>';

// foreach ($members as $member) {
//   $tableData .= '<tr>';
//   $tableData .= '<td>' . $member->getid_membre(). '</td>';
//   $tableData .= '<td>' . $member->getNom() . '</td>';
//   $tableData .= '<td>' . $member->getPrenom(). '</td>';
//   $tableData .= '<td>' . $member->getAdresse() . '</td>';
//   $tableData .= '<td>' . $member->getEmail() . '</td>';
//   $tableData .= '<td>' . $member->getTelephone() . '</td>';
//   $tableData .= '<td>' .'<button class="btn btn-danger supprimer" > supprimer </button>'. '</td>';
//   $tableData .= '<td>' .'<button class="btn btn-success"> modifier </button>'. '</td>';
//   $tableData .= '</tr>';
// }

// $tableData .= '</table>';

// echo $tableData;
