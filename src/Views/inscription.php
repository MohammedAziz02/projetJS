<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Accueil Gestion de Club Sprotif</title>
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
                <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">Inscription</span></h1>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-11 col-xl-9 col-xxl-8">
                    <!-- Experience Section-->
                    <section>
                        <!-- Experience Card 1-->
                        <div class="card shadow border-0 rounded-4 mb-5">
                            <div class="card-body p-5">
                                <form action="../Controllers/inscriptionMembre.php" method="post" id="myform">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nom:</label>
                                        <input type="text" class="form-control" id="nom" name="nom">
                                        <span id="nomerror"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Prenom:</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" >
                                        <span id="prenomerror"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Adresse:</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse" >
                                        <span id="adresseerror"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email :</label>
                                        <input type="email" class="form-control" id="email" name="email" >
                                        <span id="emailerror"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">telephone:</label>
                                        <input type="text" class="form-control" id="telephone" name="telephone" >
                                        <span id="telephoneerror"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Mot de Passe:</label>
                                        <input type="password" class="form-control" id="motdepasse"   name="motdepasse">
                                        <span id="motdepasseerror"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Répéter votre Mot de passe :</label>
                                        <input type="password" class="form-control" id="motdepasse1" name="motdepasse1" >
                                        <span id="motdepasseerror1"></span>
                                    </div>
                                    <!-- <input type="submit" class="btn btn-primary col-12" name="login" value="connexion"/> -->

                                    <button type="submit" class="btn btn-primary col-12">S'inscrire</button>
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
            e.preventDefault();
            // Get form input values
            var nom = document.getElementById("nom").value;
            var prenom = document.getElementById("prenom").value;
            var adresse = document.getElementById("adresse").value;
            var email = document.getElementById("email").value;
            var telephone = document.getElementById("telephone").value;
            var motdepasse = document.getElementById("motdepasse").value;
            var motdepasse1 = document.getElementById("motdepasse1").value;

            // Clear previous error messages
            document.getElementById("nomerror").innerHTML = "";
            document.getElementById("prenomerror").innerHTML = "";
            document.getElementById("adresseerror").innerHTML = "";
            document.getElementById("emailerror").innerHTML = "";
            document.getElementById("telephoneerror").innerHTML = "";
            document.getElementById("motdepasseerror").innerHTML = "";
            document.getElementById("motdepasseerror1").innerHTML = "";

            // Perform validation
            var isValid = true;

            if (nom === "") {
                document.getElementById("nomerror").innerHTML = "<p class='alert alert-danger text-center m-1'> Veuillez entrer votre nom.";
                isValid = false;
            }

            if (prenom === "") {
                document.getElementById("prenomerror").innerHTML = "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre prénom.";
                isValid = false;
            }

            if (adresse === "") {
                document.getElementById("adresseerror").innerHTML = "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre adresse.</p>";
                isValid = false;
            }

            if (email === "") {
                document.getElementById("emailerror").innerHTML = "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre adresse email.</p>";
                isValid = false;
            }

            if (telephone === "") {
                document.getElementById("telephoneerror").innerHTML = "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre numéro de téléphone.</p>";
                isValid = false;
            }

            if (motdepasse === "") {
                document.getElementById("motdepasseerror").innerHTML = "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre mot de passe.</p>";
                isValid = false;
            }

            if (motdepasse !== motdepasse1) {
                document.getElementById("motdepasseerror1").innerHTML = "<p class='alert alert-danger text-center m-1'>Les mots de passe ne correspondent pas.</p>";
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