<?php


require __DIR__ . "/../../vendor/autoload.php";
session_start();
if (!isset($_SESSION['user'])) {

    header("location:connexion.php");
} else {
    $user = $_SESSION['user'];
}

echo "<script> var idMembre=" . $user->getid_membre() . ";</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Membre</title>

    <!-- Custom fonts for this template-->
    <link href="../../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require "./sideBarMembre.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" name="search" id="search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" id="searchButton" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $user->getNom() . " " . $user->getPrenom()   ?></span>
                                <img class="img-profile rounded-circle" src="../../public/img/pic_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#modalModifierProfil">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div id="table-container">

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- c'est le modal de Logout -->
    <?php require "./LogoutModal.php" ?>

    <!-- c'est le modal de la formulaire ajouter Plan d'inscription -->





    <?php require "./ModalSupprimerPlanInscription.php" ?>
    <?php require "./ModalEchecChoixPlanInscription.php" ?>
    <?php require "./ModalProfilModification.php" ?>



    <?php  ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/js/sb-admin-2.min.js"></script>

    <script src="../../public/js/scriptforPlanInscription.js"></script>

    <script>
        function getXhr() {
            let xhr = null;
            try {
                xhr = new XMLHttpRequest();
                console.log("Your browser support AJAX!");
            } catch (e) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                    try {
                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {
                        console.log("Your browser does not support AJAX!");
                    }
                }
            }
            return xhr;
        }

        const xhr = getXhr();
        /////////////////////////////////////////////////////////////
        //fetch planInscriptions selon la reponse
        var response;

        var idInscription;

        function fetchMesPlans(response) {
            var tableContainer = document.getElementById('table-container');


            // Clear existing content
            tableContainer.innerHTML = '';

            // Create and populate the table
            var table = document.createElement('table');
            table.classList.add('table', 'table-striped', 'table-hover');


            // Create the table header
            var headerRow = table.insertRow();

            var id_Inscription = headerRow.insertCell();
            id_Inscription.textContent = 'Id Inscription';
            id_Inscription.classList.add("text-center");
            id_Inscription.hidden = true;

            var nomPlan = headerRow.insertCell();
            nomPlan.textContent = 'Nom du Plan';
            nomPlan.classList.add("text-center");

            var description = headerRow.insertCell();
            description.textContent = 'Description';
            description.classList.add("text-center");

            var date = headerRow.insertCell();
            date.textContent = 'Date';
            date.classList.add("text-center");

            var etat = headerRow.insertCell();
            etat.textContent = 'Etat';
            etat.classList.add("text-center");

            var Action = headerRow.insertCell();
            Action.textContent = 'Action';
            Action.colSpan = 2;
            Action.classList.add("text-center")

            // ... add more header cells for other member properties

            for (var i = 0; i < response.length; i++) {
                var plan = response[i];
                var row = table.insertRow();

                // Add the plan data to the table cells
                var cell0 = row.insertCell();
                cell0.textContent = plan.id_Inscription;
                cell0.hidden = true;
                cell0.classList.add("text-center");

                var cell1 = row.insertCell();
                cell1.textContent = plan.nomPlanInscription;
                cell1.classList.add("text-center");

                var cell2 = row.insertCell();
                cell2.textContent = plan.description;
                cell2.classList.add("text-center");

                var cell3 = row.insertCell();
                cell3.textContent = plan.dateInscription;
                cell3.classList.add("text-center");

                var cell4 = row.insertCell();
                cell4.textContent = plan.etat;
                cell4.classList.add("text-center");

                var choixCell = row.insertCell();
                var supprimerButton = document.createElement('button');
                supprimerButton.textContent = 'Supprimer';
                supprimerButton.classList.add('btn', 'btn-danger');
                choixCell.appendChild(supprimerButton);
                choixCell.classList.add('text-center');
                //on doit tout d'abord ajouter les attributs pour addentifier le modal de confirmation de suppression
                supprimerButton.setAttribute('data-toggle', 'modal');
                supprimerButton.setAttribute('data-target', '#supprimerPlanModal');
                //ici c'est l'évenement de button supprimer qu'on on clique sur la button le modal de confirmation de suppression pop up
                // il contient déja une button donc on doit faire une nouvelle event sur la button supprimer de button
                supprimerButton.addEventListener("click", (e) => {
                    //ici on identifie le button supprimer du modal et on fait alors la logique du suppression
                    var confirmsupprimerButton = document.getElementById('confirmDeletePlan');
                    idInscription = e.target.parentElement.parentElement.firstChild.innerText;
                    console.log(idInscription);
                    confirmsupprimerButton.addEventListener('click', function() {
                        const elem = e.target.parentElement.parentElement.firstChild;
                    });

                })

                tableContainer.appendChild(table);
            }
        }

        document.getElementById("btnAfficherMesPlans").addEventListener("click", () => {
            type = "mesPlansInscriptions";
            console.log("ok");
            console.log(idMembre);
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    response = JSON.parse(xhr.responseText);
                    fetchMesPlans(response);
                }
            });
            var formData = new FormData();
            formData.append("idMembre", idMembre);
            formData.append("action", "afficherMesPlans");
            xhr.open("POST", "../Controllers/traitementInscription.php");
            xhr.send(formData);
        });


        document.getElementById("confirmDeletePlan").addEventListener("click", () => {
            type = "planInscription";
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    response = JSON.parse(xhr.responseText);
                    fetchMesPlans(response);
                }
            });
            var formData = new FormData();
            formData.append("idMembre", idMembre);
            formData.append("idInscription", idInscription);
            formData.append("action", "supprimerInscription");
            xhr.open("POST", "../Controllers/traitementInscription.php");
            xhr.send(formData);
            $("#supprimerPlanModal").modal("hide");



        });






        // searching
        var type = "planInscription";
        var tableContainer = document.getElementById('table-container');
        const searchButton = document.getElementById("searchButton");
        searchButton.addEventListener("click", (e) => {
            var searchValue = document.getElementById("search").value;
            console.log(searchValue);

            if (xhr.readyState == 4 && xhr.status == 200) {
                // console.log(xhr.responseText);
                if (type === "planInscription") {
                    console.log(type);
                    // Request succeeded
                    response = JSON.parse(xhr.responseText);
                    fetchPlanInscriptionsForMembre(response);
                } else if (type === "mesPlansInscriptions") {
                    console.log(type);
                    // Request succeeded
                    response = JSON.parse(xhr.responseText);
                    fetchMesPlans(response);
                }
            }

            var formData = new FormData();
            formData.append("idMembre", idMembre);
            formData.append("type", type);
            formData.append("search", searchValue);
            formData.append("action", "search");

            xhr.open("POST", "../Controllers/traitementMembre.php");
            xhr.send(formData);

            //
        });




        // -------------------------Plan Inscription -------------------------------//

        function fetchPlanInscriptionsForMembre(response) {
            console.log("here");
            var tableContainer = document.getElementById('table-container');


            // Clear existing content
            tableContainer.innerHTML = '';

            // Create and populate the table
            var table = document.createElement('table');
            table.classList.add('table', 'table-striped', 'table-hover');


            // Create the table header
            var headerRow = table.insertRow();

            var Id = headerRow.insertCell();
            Id.textContent = 'Id';
            Id.classList.add("text-center");
            Id.hidden = true;

            var Nom = headerRow.insertCell();
            Nom.textContent = 'Nom du Plan';
            Nom.classList.add("text-center");

            var description = headerRow.insertCell();
            description.textContent = 'Description';
            description.classList.add("text-center");

            var prix = headerRow.insertCell();
            prix.textContent = 'Prix';
            prix.classList.add("text-center");

            var Action = headerRow.insertCell();
            Action.textContent = 'Action';
            Action.colSpan = 2;
            Action.classList.add("text-center")



            // ... add more header cells for other member properties

            for (var i = 0; i < response.length; i++) {
                var plan = response[i];
                var row = table.insertRow();

                // Add the plan data to the table cells
                var cell1 = row.insertCell();
                cell1.textContent = plan.idPlanInscription;
                cell1.hidden = true;
                cell1.classList.add("text-center");

                var cell2 = row.insertCell();
                cell2.textContent = plan.nom;
                cell2.classList.add("text-center");

                var cell3 = row.insertCell();
                cell3.textContent = plan.description;
                cell3.classList.add("text-center");

                var cell4 = row.insertCell();
                cell4.textContent = plan.prix;
                cell4.classList.add("text-center");

                var choixCell = row.insertCell();
                var choiceButton = document.createElement('button');
                choiceButton.textContent = 'Choisir';
                choiceButton.classList.add('btn', 'btn-primary');
                choixCell.appendChild(choiceButton);
                choixCell.classList.add('text-center');
                choiceButton.addEventListener("click", (e) => {
                    console.log("boutton");
                    var elem = "";
                    elem = e.target.parentElement.parentElement.firstChild;
                    xhr.addEventListener("readystatechange", () => {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            if (xhr.responseText == "failed") {
                                console.log("echec");
                                choiceButton.setAttribute('data-toggle', 'modal');
                                choiceButton.setAttribute('data-target', '#echecChoixPlanInscriptionModal');
                                $("#echecChoixPlanInscriptionModal").modal("show");
                            } else {
                                console.log("succes");
                                $("#echecChoixPlanInscriptionModal").modal("hide");
                            }
                        }
                    });
                    const formData = new FormData();
                    formData.append("idPlanInscription", elem.innerText);
                    formData.append("idMembre", idMembre);
                    formData.append("action", "ajouterInscription");
                    console.log(elem.innerText);
                    xhr.open("POST", "../Controllers/traitementInscription.php", true);
                    xhr.send(formData);
                    $("#choixPlanInscriptionModal").modal("hide");

                });

                tableContainer.appendChild(table);
            }
        }



        document.getElementById("btnafficherPlans").addEventListener("click", () => {
            type = "planInscription";
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    try {
                        response = JSON.parse(xhr.responseText);
                        console.log("Parsed response:", response); // Log the parsed response
                        fetchPlanInscriptionsForMembre(response);
                    } catch (error) {}

                }
            });
            var formData = new FormData();
            formData.append("action", "afficherTous");
            xhr.open("POST", "../Controllers/traitementInscription.php");
            xhr.send(formData);
        });
    </script>
</body>

</html>