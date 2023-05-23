import getXhr from "./xhrobject";
const xhr = getXhr();
//---------------------------------- get all plan d'inscriptions pour les affichés-------------------------------------------------//
export function getAllInscriptionsPlans() {
    const formData = new FormData();
    formData.append("action", 'afficherTous');
    xhr.open("POST", "../Controllers/traitementPlanInscription.php");
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
                    confirmDeleteButton.addEventListener('click', function () {
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
    })
}

import { typeObject } from "./type";

var btnafficherPlans = document.getElementById("btnafficherPlans");
btnafficherPlans.addEventListener("click", () => {
    typeObject.type = "planInscription";
    getAllInscriptionsPlans();
})

// ------------------------------ function pour la validation de la formulaire d'ajout d'un plan d'inscription ------------------------------//

function validerFormPlanInscription(champnom,champdescription,champprix,champnomerror,champdescriptionerror,champprixerror){
    let is_valid = true;
    // on va verifier si le formulaire est valide ou non
    // mettre les messages d'erreur à vide
    champnomerror.innerHTML = "";
    champdescriptionerror.innerHTML = "";
    champprixerror.innerHTML = "";
    // on va verifier si le formulaire est valide ou non    
    // le formaulaire d'ajout d'un plan d'inscription a comme id de nom=nom
    if (champnom.value == "") {
        is_valid = false;
        champnomerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs du nom</p>"
    }
    // le formaulaire d'ajout d'un plan d'inscription a comme id de description=description
    if (champdescription.value == "") {
        is_valid = false;
        champdescriptionerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs du description</p>"

    }
    // le formaulaire d'ajout d'un plan d'inscription a comme id de prix=prix
    if (champprix.value == "") {
        is_valid = false;
        champprixerror.innerHTML = "<p class='alert alert-danger mt-1 text-center'>veuillez remplir le champs du prix</p>"
    }

    return is_valid;
}


//-------------------------------------------ajout un plan d'inscription && validation de formulaire-------------------------------------------------//
var btnajouterplanInscription = document.getElementById("ajouterPlandinscription");
var formulairedePlanInscription = document.getElementById("formulairePlanInscription");

btnajouterplanInscription.addEventListener('click', (e) => {
    // typeObject.type = "planInscription";

    e.preventDefault();
    var nom=document.getElementById("nom");
    var description=document.getElementById("description");
    var prix=document.getElementById("prix");
    var nomerror=document.getElementById("nomerror");
    var descritpionerror=document.getElementById("descritpionerror");
    var prixerror=document.getElementById("prixerror");

    // appel de la methode de validation de formulaire qui retourne true or false
    var is_valid= validerFormPlanInscription(nom,description,prix,nomerror,descritpionerror,prixerror)
    // si la formulaire est valide alors on peut faire l'ajax
    if (is_valid) {
        const formData = new FormData(formulairedePlanInscription);
        formData.append("action", 'ajouterplaninscription');
        xhr.open("POST", "../Controllers/traitementPlanInscription.php", true);
        xhr.send(formData);
        formulairedePlanInscription.reset();
        $("#modalAjouterPlanInscription").modal('hide');
        getAllInscriptionsPlans();
    }

})

//---------------------------------------modifier un plan d'inscription -----------------------------
var modfierPlanInscriptionbtninModal = document.getElementById('modfierPlanInscriptionbtninModal');
modfierPlanInscriptionbtninModal.addEventListener("click", (e) => {
    // typeObject.type = "planInscription";
    e.preventDefault();

    // avoir tous les champs de formulaire soit de input soit d'erreur
    var nomplan=document.getElementById("nomplan");
    var descriptionplan=document.getElementById("descriptionplan");
    var prixplan=document.getElementById("prixplan");
    var nomerror=document.getElementById("nomerrormodifier");
    var descritpionerrormodifier=document.getElementById("descritpionerrormodifier");
    var prixerrormodifier=document.getElementById("prixerrormodifier");

    // appel à la méthode validerFormPlanInscription
    var is_valid=validerFormPlanInscription(nomplan,descriptionplan,prixplan,nomerror,descritpionerrormodifier,prixerrormodifier)

    if (is_valid) {
        var formulaireplaninscription = document.getElementById("formulaireModifierPlanInscription");
        var formData = new FormData(formulaireplaninscription);
        formData.append("action", "modifierplan");
        console.log(formData);
        xhr.open("POST", "../Controllers/traitementPlanInscription.php", true);
        xhr.send(formData);

        formulaireplaninscription.reset();
        $('#modalmodifierPlanInscription').modal('hide');
        getAllInscriptionsPlans();

    }
});












