import getXhr from "./xhrobject";

const xhr = getXhr();



//-----------------------------------------------------------------------------------//

function getAllMembres() {
    const formData = new FormData();
    formData.append("action", 'afficherTous');
    xhr.open("POST", "../Controllers/traitementMembre.php", true);
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
                    confirmDeleteButton.addEventListener('click', function () {
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


//------------------------------------------------------------------------------------------------//
var modifierMembreInModal = document.getElementById('modifierMembreInModal');
modifierMembreInModal.addEventListener("click", (e) => {
    typeObject.type = "membre";
    e.preventDefault();
    const elem = e.target.parentElement.parentElement.children;
    console.log(elem[0].innerText);
    var formulaire = document.getElementById("formulaire");
    console.log(formulaire);
    if (xhr.readyState == 4 && xhr.status == 200) {
        console.log(xhr.responseText);
    }
    var formData = new FormData(formulaire);
    formData.append("action", "modifier");
    console.log(formData);
    xhr.open("POST", "../Controllers/traitementMembre.php", true);
    xhr.send(formData);

    formulaire.reset();
    $('#modalModifierMembre').modal('hide');
    getAllMembres();

});

//--------------------------------------------------------------------------------------//

document.getElementById("afficher-membre-btn").addEventListener("click", () => {
    typeObject.type = "membre";
    getAllMembres();

})


// var type = "membre";
import { typeObject } from "./type";

const searchButton = document.getElementById("searchButton");
searchButton.addEventListener("click", (e) => {
    var searchValue = document.getElementById("search").value;
    console.log(searchValue);
    if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);
       var arr= Object.keys( response[0]);
       console.log("tt",arr);


    }
    var formData = new FormData();
    formData.append("type", typeObject.type);
    formData.append("search", searchValue);
    formData.append("action", "search");

    xhr.open("POST", "../Controllers/traitementMembre.php");
    xhr.send(formData);
});


