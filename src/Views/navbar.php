<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container px-5">
        <a class="navbar-brand" href="index.html"><span class="fw-bolder text-primary">Gestion de Club Bookidan Sport</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <!-- <li class="nav-item"><a class="nav-link" href="http://localhost/JAVASCRIPT%20PROJECT/index.php" >Home</a></li> -->
                <li class="nav-item"><a class="nav-link" href=<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/JAVASCRIPT%20PROJECT/index.php"?> >Home</a></li>
                <li class="nav-item"><a class="nav-link" href=<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/JAVASCRIPT%20PROJECT//src/Views/inscription.php" ?> >Inscription</a></li>
                <li class="nav-item"><a class="nav-link" href=<?php echo "http://" . $_SERVER['SERVER_NAME'] . "/JAVASCRIPT%20PROJECT//src/Views/connexion.php" ?>>Connexion</a></li>
             
            </ul>
        </div>
    </div>
</nav>