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
                        <!-- <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table> -->

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- test   -->

    <div> 
    
</div>



    <!-- c'est le modal de la formulaire ajouter Plan d'inscription -->
    <?php require "./ModalAjouterPlanInscription.php" ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/js/sb-admin-2.min.js"></script>

    <script>

    function getAllMembres() {
    const xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //let res = document.getElementById('res');
            //res.hidden = false;
            var membres=JSON.parse(xhr.responseText);
            console.log(typeof membres);
            membres.map(e=>console.log(createMembre(e)));   

            //displayEtudiants(JSON.parse(xhr.responseText));
        }
    });
    const dataform = new FormData();
    dataform.append("action", "afficherTous");
            xhr.open("POST", "../Controllers/traitementMembre.php", true);
    xhr.send(dataform);
    }
    getAllMembres();


function createMembre(membre) {
    let tr = document.createElement("tr");
    let td1 = document.createElement("td");
    td1.innerText = membre["id_membre"];
    let td2 = document.createElement("td");
    td2.innerText = membre["nom"];
    let td3 = document.createElement("td");
    td3.innerText = membre["prenom"];
    let td4 = document.createElement("td");
    td4.innerText = membre["adresse"];
    let td5 = document.createElement("td");
    td5.innerText = membre["email"];
    let td6 = document.createElement("td");
    td6.innerText = membre["telephone"];
    let td7 = document.createElement("td");
    //td7.innerHTML=`<button class='btn btn-primary mx-1 onclick='updateStudent''>Modifier</button><button class='btn btn-danger' onclick=${deleteStudent}>Supprimer</button>`
    let supprimerbtn = document.createElement("button");
    let modifierbtn = document.createElement("button");
    supprimerbtn.className = "btn btn-danger";
    supprimerbtn.innerText = "supprimer";
    supprimerbtn.addEventListener("click", supprimerMembre);

    modifierbtn.className = "btn btn-primary";
    modifierbtn.innerText = "modifier";
    
    modifierbtn.addEventListener("click", modifierMembre);
    td7.append(supprimerbtn);
    td7.append(modifierbtn);
    tr.append(td1, td2, td3, td4, td5, td6, td7);
    return tr;

}

function supprimerMembre(){
    const elem = e.target.parentElement.parentElement.firstChild;
    if (xhr.readyState == 4 && xhr.status === 200) {
    }
    const formData = new FormData();
    formData.append("id", elem.innerText);
    formData.append("action", "supprimer");
    xhr.open("POST", "../Controllers/traitementMembre.php", true);
    xhr.send(formData);
    getAllMembres();
};
function modifierMembre(){

};

  </script>





</body>

</html>