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


                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">




                        <div class="topbar-divider d-none d-sm-block"></div>






                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
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
    <?php require "./ModalAjouterPlanInscription.php" ?>
    <?php require "./ModalModifierMembre.php" ?>

    <?php require "./ModalSupprimerMembre.php" ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/js/sb-admin-2.min.js"></script>

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


        function getAllMembres() {
            const formData = new FormData();
            formData.append("action", 'afficherTousmembres');
            xhr.open("POST", "../Controllers/test.php", true);
            xhr.send(formData);
            xhr.addEventListener("readystatechange", () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Request succeeded
                    var response = JSON.parse(xhr.responseText);
                    console.log(response);
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
                }
            })

        }
        var modifierMembreInModal = document.getElementById('modifierMembreInModal');
        modifierMembreInModal.addEventListener("click", (e) => {
            e.preventDefault();
            const elem = e.target.parentElement.parentElement.children;
            console.log(elem[0].innerText);
            var formulaire = document.getElementById("formulaire");
            console.log(formulaire);
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
            }
            formData = new FormData(formulaire);
            formData.append("action", "modifier");
            console.log(formData);
            xhr.open("POST", "../Controllers/traitementMembre.php", true);
            xhr.send(formData);

            formulaire.reset();
            $('#modalModifierMembre').modal('hide');
            getAllMembres();
           
        });

        document.getElementById("afficher-membre-btn").addEventListener("click", () => {
            getAllMembres();
        })
    </script>

</body>

</html>


</body>

</html>