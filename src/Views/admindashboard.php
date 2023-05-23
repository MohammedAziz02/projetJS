<?php


require __DIR__ . "/../../vendor/autoload.php";
session_start();
if (!isset($_SESSION['user'])) {

    header("location:connexion.php");
} else {
    $user = $_SESSION['user'];
    // print_r($user);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Admin</title>

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
        <?php require "./sideBar.php" ?>
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
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> -->


                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
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
                    <div class=" d-flex justify-content-center align-items-center">
                        <p class="badge  badge-success text-center font-weight-bold">bienvenue a votre Application</p>

                    </div>
                    <hr class="mt-2 mb-4">
                    <div id="table-container" class="d-flex justify-content-center align-items-center shadow  rounded">
                        <img width="500px" src="../../public/img/pic_acceuil.jpg" />

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
    <?php require "./ModalAjouterPlanInscription.php" ?>
    <?php require "./ModalModifierMembre.php" ?>

    <?php require "./ModalSupprimerMembre.php" ?>

    <?php require "./modifierPlanInscriptionModal.php" ?>

    <?php require "./ModalConfirmerInscription.php" ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/js/sb-admin-2.min.js"></script>

    <script src="../../public/js/scriptforPlanInscription.js" type="module"></script>

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
        function getAllInscriptionsPlans() {
            const formData = new FormData();
            formData.append("action", 'afficherTous');
            xhr.open("POST", "../Controllers/traitementPlanInscription.php", true);
            xhr.send(formData);
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Request succeeded
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
                    fetchPlanInscriptions(response);
                }
            })
        }
        //fetch membres selon la reponse
        function fetchMembres(response) {
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

            var Nom = headerRow.insertCell();
            Nom.textContent = 'Nom';
            Nom.classList.add("text-center");

            var Prenom = headerRow.insertCell();
            Prenom.textContent = 'Prenom';
            Prenom.classList.add("text-center");

            var Adresse = headerRow.insertCell();
            Adresse.textContent = 'Adresse';
            Adresse.classList.add("text-center");


            var Email = headerRow.insertCell();
            Email.textContent = 'Email';
            Email.classList.add("text-center");

            var Telephone = headerRow.insertCell();
            Telephone.textContent = 'Telephone';
            Telephone.classList.add("text-center");

            var Action = headerRow.insertCell();
            Action.textContent = 'Action';
            Action.colSpan = 2;
            Action.classList.add("text-center")


            // ... add more header cells for other member properties

            for (var i = 0; i < response.length; i++) {
                var member = response[i];
                var row = table.insertRow();

                // Add the member data to the table cells
                var cell1 = row.insertCell();
                cell1.textContent = member.id_membre;
                cell1.classList.add("text-center");

                var cell2 = row.insertCell();
                cell2.textContent = member.nom;
                cell2.classList.add("text-center");

                var cell3 = row.insertCell();
                cell3.textContent = member.prenom;
                cell3.classList.add("text-center");


                var cell4 = row.insertCell();
                cell4.textContent = member.adresse;
                cell4.classList.add("text-center");
                var cell5 = row.insertCell();
                cell5.textContent = member.email;
                cell5.classList.add("text-center");

                var cell6 = row.insertCell();
                cell6.textContent = member.telephone;
                cell6.classList.add("text-center");


                var modifierCell = row.insertCell();
                var modifierButton = document.createElement('button');
                modifierButton.setAttribute("data-toggle", "modal");
                modifierButton.setAttribute("data-target", "#modalModifierMembre");
                modifierButton.textContent = 'Modifier';
                modifierButton.classList.add('btn', 'btn-success');
                modifierCell.appendChild(modifierButton);
                modifierCell.classList.add('text-center');
                modifierButton.addEventListener("click", (e) => {
                    const elem = e.target.parentElement.parentElement.children;
                    var modalNom = document.getElementById('modalNom');
                    idMembre.value = elem[0].innerText;
                    modalNom.value = elem[1].innerText;
                    prenom.value = elem[2].innerText;
                    adresse.value = elem[3].innerText;
                    email.value = elem[4].innerText;
                    telephone.value = elem[5].innerText;
                });




                var supprimerCell = row.insertCell();
                var supprimerButton = document.createElement('button');
                supprimerButton.textContent = 'Supprimer';
                supprimerButton.classList.add('btn', 'btn-danger');
                supprimerCell.appendChild(supprimerButton);
                supprimerCell.classList.add('text-center');
                //on doit tout d'abord ajouter les attributs pour addentifier le modal de confirmation de suppression
                supprimerButton.setAttribute('data-toggle', 'modal');
                supprimerButton.setAttribute('data-target', '#supprimerModal');
                //ici c'est l'évenement de button supprimer qu'on on clique sur la button le modal de confirmation de suppression pop up
                // il contient déja une button donc on doit faire une nouvelle event sur la button supprimer de button
                supprimerButton.addEventListener("click", (e) => {
                    //ici on identifie le button supprimer du modal et on fait alors la logique du suppression
                    var confirmDeleteButton = document.getElementById('confirmDelete');
                    confirmDeleteButton.addEventListener('click', function() {
                        const elem = e.target.parentElement.parentElement.firstChild;
                        const formData = new FormData();
                        formData.append("id", elem.innerText);
                        formData.append("action", "supprimer");
                        xhr.open("POST", "../Controllers/traitementMembre.php", true);
                        xhr.send(formData);

                        // mn b3d ma lmodal kaytl3 khsna mn b3d mancliquiw 3la supprimer lmodel ymchi mayb9ach donc khsna nzido 
                        $('#supprimerModal').modal('hide');
                        getAllMembres();

                    });

                })

                tableContainer.appendChild(table);
            }
        };

        //fetch planInscriptions selon la reponse
        function fetchPlanInscriptions(response) {
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


                var modifierCell = row.insertCell();
                var modifierButton = document.createElement('button');
                modifierButton.setAttribute("data-toggle", "modal");
                // ajouter l'id du Modal ici
                modifierButton.setAttribute("data-target", "#modalmodifierPlanInscription");
                modifierButton.textContent = 'Modifier';
                modifierButton.classList.add('btn', 'btn-success');
                modifierCell.appendChild(modifierButton);
                modifierCell.classList.add('text-center');
                modifierButton.addEventListener("click", (e) => {
                    const elem = e.target.parentElement.parentElement.children;

                    idPlan.value = elem[0].innerText;
                    nomplan.value = elem[1].innerText;
                    descriptionplan.value = elem[2].innerText;
                    prixplan.value = elem[3].innerText;
                });




                var supprimerCell = row.insertCell();
                var supprimerButton = document.createElement('button');
                supprimerButton.textContent = 'Supprimer';
                supprimerButton.classList.add('btn', 'btn-danger');
                supprimerCell.appendChild(supprimerButton);
                supprimerCell.classList.add('text-center');
                //on doit tout d'abord ajouter les attributs pour addentifier le modal de confirmation de suppression
                supprimerButton.setAttribute('data-toggle', 'modal');
                supprimerButton.setAttribute('data-target', '#supprimerModal');
                //ici c'est l'évenement de button supprimer qu'on on clique sur la button le modal de confirmation de suppression pop up
                // il contient déja une button donc on doit faire une nouvelle event sur la button supprimer de button
                supprimerButton.addEventListener("click", (e) => {
                    //ici on identifie le button supprimer du modal et on fait alors la logique du suppression
                    var confirmDeleteButton = document.getElementById('confirmDelete');
                    confirmDeleteButton.addEventListener('click', function() {
                        const elem = e.target.parentElement.parentElement.firstChild;
                        const formData = new FormData();
                        formData.append("id", elem.innerText);
                        formData.append("action", "supprimer");
                        xhr.open("POST", "../Controllers/traitementPlanInscription.php", true);
                        xhr.send(formData);

                        // mn b3d ma lmodal kaytl3 khsna mn b3d mancliquiw 3la supprimer lmodel ymchi mayb9ach donc khsna nzido 
                        $('#supprimerModal').modal('hide');
                        getAllInscriptionsPlans();

                    });

                })

                tableContainer.appendChild(table);
            }
        }


        ////////////////////////////////////////////////////////////get_all_members///////////////////////////////

        function getAllMembres() {
            const formData = new FormData();
            formData.append("action", 'afficherTous');
            xhr.open("POST", "../Controllers/traitementMembre.php", true);
            xhr.send(formData);
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Request succeeded
                    var response = JSON.parse(xhr.responseText);
                    fetchMembres(response);
                    //console.log(response);
                }
            })
        }
        //------------------------------- modifier Membre----------------------------------------------//
        var modifierMembreInModal = document.getElementById('modifierMembreInModal');
        modifierMembreInModal.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("bttttttttttttnn mm");


            // const elem = e.target.parentElement.parentElement.children;
            // console.log(elem[0].innerText);
            var formulaire = document.getElementById("formulaire");
            // console.log(formulaire);


            // if (xhr.readyState == 4 && xhr.status == 200) {
            //     console.log(xhr.responseText);
            // }

            // les id des champs des erreurs
            var nomerror = document.getElementById("nomerrormembre");
            var prenomerror = document.getElementById("prenomerrormembre");
            var adresseerror = document.getElementById("adresseerrormembre");
            var emailerror = document.getElementById("emailerrormembre");
            var numeroerror = document.getElementById("numeroerrormembre");

            // les valeurs des inputs des la formulaire de la modification d'un membre
            var nomMembre = document.getElementById("modalNom");
            var prenomMembre = document.getElementById("prenom");
            var adresseMembre = document.getElementById("adresse");
            var emailMembre = document.getElementById("email");
            var numeroMembre = document.getElementById("telephone");

            console.log("nooom", nomMembre.value);


            var isvalid = true;

            nomerror.innerHTML = "";
            prenomerror.innerHTML = "";
            adresseerror.innerHTML = "";
            emailerror.innerHTML = "";
            numeroerror.innerHTML = "";
            // on va verifier si le formulaire est valide ou non    
            // le formaulaire d'ajout d'un plan d'inscription a comme id de nom=nom
            if (nomMembre.value == "") {
                isvalid = false;
                nomerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs du nom</p>"
            }
            if (prenomMembre.value == "") {
                isvalid = false;
                prenomerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs du prenom</p>"
            }

            if (adresseMembre.value == "") {
                isvalid = false;
                adresseerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs de l'adresse</p>"
            }

            if (emailMembre.value == "") {
                isvalid = false;
                emailerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs de l'Email</p>"
            }

            if (numeroMembre.value == "") {
                isvalid = false;
                numeroerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs de Numero</p>"
            }



            if (isvalid) {
                formData = new FormData(formulaire);
                formData.append("action", "modifier");
                console.log(formData);
                xhr.open("POST", "../Controllers/traitementMembre.php", true);
                xhr.send(formData);
                formulaire.reset();
                $('#modalModifierMembre').modal('hide');
                getAllMembres();
            }
        });


        // ----------------------------------pour aider a savoir on est dans les membres et lorsque on veut chercher un membre
        // on clique sur le button chercher et on fait la recherche dans la base de données et on affiche le resultat dans le tableau
        // la rechereche se fait graçe au type="membre"
        document.getElementById("afficher-membre-btn").addEventListener("click", () => {
            type = "membre";
            getAllMembres();
        });
        document.getElementById("btnafficherPlans").addEventListener("click", () => {
            type = "planInscription";
            getAllInscriptionsPlans();
        });

        // searching
        var type;
        var response;
        var tableContainer = document.getElementById('table-container');
        const searchButton = document.getElementById("searchButton");

        searchButton.addEventListener("click", (e) => {
            var searchValue = document.getElementById("search").value;
            console.log(searchValue);
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // console.log(xhr.responseText);
                    if (type === "planInscription") {
                        console.log(type);
                        // Request succeeded
                        response = JSON.parse(xhr.responseText);
                        fetchPlanInscriptions(response);
                        // console.log(response);

                    } else if (type === "membre") {
                        console.log(type);
                        response = JSON.parse(xhr.responseText);
                        fetchMembres(response);
                        console.log(response);
                    } else if (type === "inscription") {
                        console.log(type);
                        response = JSON.parse(xhr.responseText);
                        // fetchInscriptions(response);
                        console.log(response);
                        dessinerTableauInscriptioninAdmin(response);

                    }


                }
            });

            var formData = new FormData();
            formData.append("type", type);
            formData.append("search", searchValue);
            formData.append("action", "search");

            xhr.open("POST", "../Controllers/traitementMembre.php");
            xhr.send(formData);

            //
        });




        // ---------------------------- get All inscriptions in Admin -----------------------------------------------------------------------------

        function dessinerTableauInscriptioninAdmin(response) {
            var tableContainer = document.getElementById('table-container');
            // Clear existing content
            tableContainer.innerHTML = '';
            // Create and populate the table
            var table = document.createElement('table');
            table.classList.add('table', 'table-striped', 'table-hover'); // Create the table header
            var headerRow = table.insertRow();

            var Id = headerRow.insertCell();
            Id.textContent = 'Id_Inscription';
            Id.classList.add("text-center");

            var Nom_Membre = headerRow.insertCell();
            Nom_Membre.textContent = 'Nom du Membre';
            Nom_Membre.classList.add("text-center");

            var Prenom_Membre = headerRow.insertCell();
            Prenom_Membre.textContent = 'Prenom du Membre';
            Prenom_Membre.classList.add("text-center");


            var nom_Plan_Inscription = headerRow.insertCell();
            nom_Plan_Inscription.textContent = "nom Plan d'Inscription";
            nom_Plan_Inscription.classList.add("text-center");

            var descriptionPlanInscription = headerRow.insertCell();
            descriptionPlanInscription.textContent = "description Plan d'Inscription";
            descriptionPlanInscription.classList.add("text-center");

            var prix_Plan = headerRow.insertCell();
            prix_Plan.textContent = "Prix";
            prix_Plan.classList.add("text-center");

            var etat = headerRow.insertCell();
            etat.textContent = "état";
            etat.classList.add("text-center");


            var Action = headerRow.insertCell();
            Action.textContent = 'Action';
            Action.classList.add("text-center")



            // ... add more header cells for other member properties

            for (var i = 0; i < response.length; i++) {
                var data = response[i];
                var row = table.insertRow();

                // Add the data data to the table cells
                var cell1 = row.insertCell();
                cell1.textContent = data.id_Inscription;
                cell1.classList.add("text-center");

                var cell2 = row.insertCell();
                cell2.textContent = data.nom;
                cell2.classList.add("text-center");

                var cell3 = row.insertCell();
                cell3.textContent = data.prenom;
                cell3.classList.add("text-center");


                var cell4 = row.insertCell();
                cell4.textContent = data.nomPlanInscription;
                cell4.classList.add("text-center");

                var cell4 = row.insertCell();
                cell4.textContent = data.description;
                cell4.classList.add("text-center");

                var cell4 = row.insertCell();
                cell4.textContent = data.prix;
                cell4.classList.add("text-center");

                var cell4 = row.insertCell();
                cell4.textContent = data.etat;
                cell4.classList.add("text-center");



                var confirmcell = row.insertCell();
                var ConfirmerButton = document.createElement('button');
                ConfirmerButton.setAttribute("data-toggle", "modal");
                // ajouter l'id du Modal ici
                ConfirmerButton.setAttribute("data-target", "#ConfirmerInscription");
                ConfirmerButton.textContent = 'Confirmer';
                ConfirmerButton.classList.add('btn', 'btn-success');
                confirmcell.appendChild(ConfirmerButton);
                confirmcell.classList.add('text-center');
                ConfirmerButton.addEventListener("click", (e) => {

                    var btn_confirmer_inscription = document.getElementById("confirmerInscriptionForAMember");
                    console.log(btn_confirmer_inscription);
                    btn_confirmer_inscription.addEventListener("click", () => {
                        console.log("heyy you clicked me");
                        const elem = e.target.parentElement.parentElement.children;
                        type = "inscription";
                        var idInscription = elem[0].innerText;

                        var formData = new FormData();
                        formData.append("action", "confirmerInscription");
                        formData.append("id", idInscription);
                        xhr.open("POST", "../Controllers/traitementInscription.php");
                        xhr.send(formData);
                        $("#ConfirmerInscription").modal("hide");
                        // après la modification on doit afficher tous les inscriptions encore une fois
                        getAllInscriptionsAdmin();

                    })




                });

                tableContainer.appendChild(table);
            }
        }


        //--------------------------- function qui permet de récupérer tous les inscriptions dans la base de données ------------------------------
        function getAllInscriptionsAdmin() {
            console.log("hahowa dkhl l hna 3awtani")
            type = "inscription";
            var formData = new FormData();
            formData.append("type", type);
            formData.append("action", "affichertouslesinscriptions");
            xhr.open("POST", "../Controllers/traitementInscription.php");
            xhr.send(formData);

            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    dessinerTableauInscriptioninAdmin(response);
                }
            })
        }

        //---------------------- logique of gérer inscription admin------------------/
        var btn_gerer_inscription_admin = document.getElementById("btn-gerer-inscription-admin");
        btn_gerer_inscription_admin.addEventListener("click", () => {
            // on appele au méthode getAllInscriptionsAdmin pour afficher tous les inscriptions et les affichées dans le tableau
            getAllInscriptionsAdmin();
        });


        var btnGain = document.getElementById("btnGain");
        btnGain.addEventListener("click", () => {

            if (date1.value && date1.value) {
                xhr.addEventListener("readystatechange", () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var tableContainer = document.getElementById('table-container');
                        tableContainer.innerHTML = "";
                        tableContainer.innerHTML =  "<div class='alert alert-success text-center col-12 mt-2'>  Gain  :  " + xhr.responseText+ " DH </div>";

                    };
                });


                var formData = new FormData();
                formData.append("action", "sommeGain");
                formData.append("date1", date1.value);
                formData.append("date2", date2.value);

                xhr.open("POST", "../Controllers/traitementMembre.php");
                xhr.send(formData);
            }

        });
    </script>

</body>

</html>


</body>

</html>