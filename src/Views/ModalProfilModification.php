<?php


require __DIR__."/../../vendor/autoload.php";
session_start();
if(!isset($_SESSION['user'])){

    header("location:connexion.php");
}else{ 
    $user=$_SESSION['user'];
}

echo "<script> var idMembre=". $user->getid_membre(). ";</script>";

?>


<!-- Modal -->
<div class="modal fade" id="modalModifierProfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Un plan D'inscription</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="modifierProfilForm">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="idProfil" name="id"
                            value=<?php echo $user->getid_membre();?>>

                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom:</label>
                        <input type="text" class="form-control" id="nomProfil" name="nom"
                            value=<?php echo $user->getNom();?>>
                        <span id="nomerrorProfil"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Prenom:</label>
                        <input type="text" class="form-control" id="prenomProfil" name="prenom"
                            value=<?php echo $user->getprenom();?>>
                        <span id="prenomerrorProfil"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Adresse:</label>
                        <input type="text" class="form-control" id="adresseProfil" name="adresse"
                            value=<?php echo $user->getAdresse();?>>
                        <span id="adresseerrorProfil"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email :</label>
                        <input type="email" class="form-control" id="emailProfil" name="email"
                            value=<?php echo $user->getemail();?>>
                        <span id="emailerrorProfil"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">telephone:</label>
                        <input type="text" class="form-control" id="telephoneProfil" name="telephone"
                            value=<?php echo $user->getEmail();?>>
                        <span id="telephoneerrorProfil"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Mot de Passe:</label>
                        <input type="password" class="form-control" id="motdepasseProfil" name="motdepasse"
                            value=<?php echo $user->getpassword();?>>
                        <span id="motdepasseerrorProfil"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Répéter votre Mot de passe :</label>
                        <input type="password" class="form-control" id="motdepasse1Profil" name="motdepasse1">
                        <span id="motdepasseerror1Profil"></span>
                    </div>
                    <!-- <input type="submit" class="btn btn-primary col-12" name="login" value="connexion"/> -->

                    <button id="bntModifierProfil" type="submit" class="btn btn-primary col-12">Modifier</button>
                </form>


            </div>

        </div>
    </div>
</div>



<script type="module">
import getXhr from "../../public/js/xhrobject";
var xhr = getXhr();


document.getElementById("bntModifierProfil").addEventListener("click", (e) => {
    e.preventDefault();
    // Get form input values
    var nom = document.getElementById("nomProfil").value;
    var prenom = document.getElementById("prenomProfil").value;
    var adresse = document.getElementById("adresseProfil").value;
    var email = document.getElementById("emailProfil").value;
    var telephone = document.getElementById("telephoneProfil").value;
    var motdepasse = document.getElementById("motdepasseProfil").value;
    var motdepasse1 = document.getElementById("motdepasse1Profil").value;

    // Clear previous error messages
    document.getElementById("nomerrorProfil").innerHTML = "";
    document.getElementById("prenomerrorProfil").innerHTML = "";
    document.getElementById("adresseerrorProfil").innerHTML = "";
    document.getElementById("emailerrorProfil").innerHTML = "";
    document.getElementById("telephoneerrorProfil").innerHTML = "";
    document.getElementById("motdepasseerrorProfil").innerHTML = "";
    document.getElementById("motdepasseerror1Profil").innerHTML = "";

    // Perform validation
    var isValid = true;

    if (nom === "") {
        document.getElementById("nomerrorProfil").innerHTML =
            "<p class='alert alert-danger text-center m-1'> Veuillez entrer votre nom.";
        isValid = false;
    }

    if (prenom === "") {
        document.getElementById("prenomerrorProfil").innerHTML =
            "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre prénom.";
        isValid = false;
    }

    if (adresse === "") {
        document.getElementById("adresseerrorProfil").innerHTML =
            "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre adresse.</p>";
        isValid = false;
    }

    if (email === "") {
        document.getElementById("emailerrorProfil").innerHTML =
            "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre adresse email.</p>";
        isValid = false;
    }

    if (telephone === "") {
        document.getElementById("telephoneerrorProfil").innerHTML =
            "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre numéro de téléphone.</p>";
        isValid = false;
    }

    if (motdepasse === "") {
        document.getElementById("motdepasseerrorProfil").innerHTML =
            "<p class='alert alert-danger text-center m-1'>Veuillez entrer votre mot de passe.</p>";
        isValid = false;
    }

    if (motdepasse !== motdepasse1) {
        document.getElementById("motdepasseerror1Profil").innerHTML =
            "<p class='alert alert-danger text-center m-1'>Les mots de passe ne correspondent pas.</p>";
        isValid = false;
    }

    // If form is valid, submit the form
    if (isValid) {
        xhr.addEventListener("readystatechange", () => {
                if(xhr.readyState==4 && xhr.status==200){
                    $("#modalModifierProfil").modal("hide");
                }
        });
        var form= document.getElementById("modifierProfilForm");
        var formData = new FormData(form);
        //formData.append("idMembre",idMembre);
        formData.append("action", "modifierProfil");
        xhr.open("POST", "../Controllers/traitementMembre.php", true);
        xhr.send(formData);
        //event.target.submit();
    }

})
</script>