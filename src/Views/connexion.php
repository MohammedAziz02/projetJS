<?php

// use gestionclub\DAO\MembreDao;

// require __DIR__ . "/../../vendor/autoload.php";

// session_start();

// $message = "";

// print_r( $_POST);

echo "mmm";

if (isset($_POST["connexion"])) {
    echo "jjajajaj";
    
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Connexion</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Custom Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../public/css/styles.css" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <?php require_once "./navbar.php"  ?>


        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Connexion</span></h1>
            </div>


            <div class="row gx-5 justify-content-center">
                <div class="col-lg-11 col-xl-9 col-xxl-8">
                    <!-- Experience Section-->
                    <section>
                        <!-- Experience Card 1-->
                        <div class="card shadow border-0 rounded-4 mb-5">
                            <div class="card-body p-5">
                                <?php
                                // if (isset($_SESSION["message"])) {
                                // echo "<div class='alert alert-danger text-center'>" . $message . "</div>";
                                // }
                                ?>
                                <form  method="post" id="myform">


                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email :</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                        <span id="emailerror"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Mot de Passe:</label>
                                        <input type="password" class="form-control" id="motdepasse" name="motdepasse">
                                        <span id="motdepasseerror"></span>
                                    </div>

                                    <input type="submit" name="connexion" class="btn btn-primary col-12"  value="connexion" />
                                </form>
                            </div>
                        </div>
                    </section>



                </div>
            </div>
        </div>

        <?php require_once "./aboutus.php" ?>
    </main>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../../public/css/styles.css"></script>

    <script>
        document.getElementById("myform").addEventListener("submit", (e) => {
            // e.preventDefault();
            // Get form input values

            var email = document.getElementById("email").value;

            var motdepasse = document.getElementById("motdepasse").value;


            // Clear previous error messages

            document.getElementById("emailerror").innerHTML = "";
            document.getElementById("motdepasseerror").innerHTML = "";


            // Perform validation
            var isValid = true;



            if (email === "") {
                document.getElementById("emailerror").innerHTML = "Veuillez entrer votre adresse email.";
                isValid = false;
            }



            if (motdepasse === "") {
                document.getElementById("motdepasseerror").innerHTML = "Veuillez entrer votre mot de passe.";
                isValid = false;
            }

            // If form is valid, submit the form
            if (isValid) {
                event.target.submit();
            }

        })
    </script>

</body>

</html>