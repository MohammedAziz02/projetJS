// export default function getXhr() {
//   let xhr = null;
//   try {
//     xhr = new XMLHttpRequest();
//     console.log("Your browser support AJAX!");
//   } catch (e) {
//     try {
//       xhr = new ActiveXObject("Msxml2.XMLHTTP");
//     } catch (e) {
//       try {
//         xhr = new ActiveXObject("Microsoft.XMLHTTP");
//       } catch (e) {
//         console.log("Your browser does not support AJAX!");
//       }
//     }
//   }
//   return xhr;
// }

// const xhr = getXhr();

// //ajouter les etudiants
// function addStudent() {
//   xhr.addEventListener("readystatechange", () => {
//     if (xhr.readyState == 4 && xhr.status === 200) {
//       console.log(xhr.responseText);
//       if (xhr.responseText == "success") {
//         success.hidden = false;
//       } else if (xhr.responseText == "error") failed.hidden = false;
//     }
//   });
//   const formData = new FormData(document.getElementById("formulaire"));
//   formData.append("action", "ajouter");
//   xhr.open("POST", "./php/traitement.php", true);
//   xhr.send(formData);
// }

// //get all students

// function getAllStudents() {
//   xhr.addEventListener("readystatechange", () => {
//     if (xhr.readyState == 4 && xhr.status === 200) {
//       var students = JSON.parse(xhr.responseText);
//       listStudent.innerText = "";
//       students.map((e) => {
//         listStudent.append(createStudent(e));
//       });
//     }
//   });
//   const formData = new FormData();
//   formData.append("action", "afficherTous");
//   xhr.open("POST", "./php/traitement.php", true);
//   xhr.send(formData);
// }

// function createMembre(membre) {
//   let tr = document.createElement("tr");
//   let td1 = document.createElement("td");
//   td1.innerText = membre["id"];
//   let td2 = document.createElement("td");
//   td2.innerText = membre["nom"];
//   let td3 = document.createElement("td");
//   td3.innerText = membre["prenom"];
//   let td4 = document.createElement("td");
//   td4.innerText = membre["adresse"];
//   let td5 = document.createElement("td");
//   td5.innerText = membre["email"];
//   let td6 = document.createElement("td");
//   td6.innerText = student["telephone"];
//   let td7 = document.createElement("td");
//   //td7.innerHTML=`<button class='btn btn-primary mx-1 onclick='updateStudent''>Modifier</button><button class='btn btn-danger' onclick=${deleteStudent}>Supprimer</button>`
//   let btn = document.createElement("button");
//   let modifierbtn = document.createElement("button");
//   btn.className = "btn btn-danger";
//   btn.innerText = "supprimer";
//   btn.addEventListener("click", deleteStudent);

//   modifierbtn.className = "btn btn-primary";
//   modifierbtn.innerText = "modifier";
//   modifierbtn.addEventListener("click", updateStudent);
//   td7.append(btn);
//   td7.append(modifierbtn);
//   tr.append(td1, td2, td3, td4, td5, td6, td7);
//   return tr;
// }
// // modification d etudiant

// function updateMembre(e) {
//   isModified = true;
//   const elem = e.target.parentElement.parentElement.children;
//   console.log(elem[1].innerText);
//   //const nom=document.getElementById("nom");
//   nom.value = elem[1].innerText;
//   prenom.value = elem[2].innerText;
//   email.value = elem[3].innerText;
//   DOfbirth.value = elem[4].innerText;
//   filiere.value = elem[5].innerText;
//   if (xhr.readyState == 4 && xhr.status === 200) {
//     console.log(xhr.responseText);
//   }
//   const formData = new FormData(document.getElementById("formulaire"));
//   formData.append("id", elem[0].innerText);
//   formData.append("action", "modifier");
//   xhr.open("POST", "./php/traitement.php", true);
//   xhr.send(formData);
//   getAllStudents();
// }

// //suppression de l element
// function deleteMembre(e) {
//   const elem = e.target.parentElement.parentElement.firstChild;
//   if (xhr.readyState == 4 && xhr.status === 200) {
//   }
//   const formData = new FormData();
//   formData.append("id", elem.innerText);
//   formData.append("action", "supprimer");
//   xhr.open("POST", "./php/traitement.php", true);
//   xhr.send(formData);
//   getAllStudents();
// }

// // boutton de clique
// ajouter.addEventListener("click", (e) => {
//   e.preventDefault();
//   if (isModified) updateStudent();
//   else addStudent();
//   isModified = false;
//   getAllStudents();
// });
// getAllStudents();


//import getXhr from './utilities.js';

let modefierIsClicked = false;

function deleteStudent(e) {
    const xhr = getXhr();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            getAllEtudiant();
            if (xhr.responseText == 'success') {
                document.getElementById("succes").hidden = false;
                document.getElementById("succes").innerText = "Etudiant supprimé avec succès";
                setTimeout(() => {
                    document.getElementById("succes").hidden = true;
                }, 2000);
            } else {
                document.getElementById("failed").hidden = false;
                document.getElementById("failed").innerText = "Erreur lors de la suppression";
                setTimeout(() => {
                    document.getElementById("failed").hidden = true;
                }, 2000);

            }
        }
    });

    const dataform = new FormData();
    dataform.append("action", "supprimer");
    console.log(e.target.parentElement.parentElement.firstChild.innerText);
    dataform.append("id", e.target.parentElement.parentElement.firstChild.innerText);
    xhr.open("POST", "./php/traitement.php", true);
    xhr.send(dataform);
}

function addSudent() {
    const xhr = getXhr();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = document.getElementById('res');
            res.hidden = false;
            getAllEtudiant();
            if (xhr.responseText == 'success') {
                document.getElementById("succes").hidden = true;
                setTimeout(() => {
                    document.getElementById("succes").hidden = true;
                }, 3000);
            } else {
                document.getElementById("failed").hidden = true;
                setTimeout(() => {
                    document.getElementById("failed").hidden = true;
                }, 3000);

            }
        }
    });

    const dataform = new FormData(document.getElementById("formulaire"));

    dataform.append("action", "ajouter");

    xhr.open("POST", "./php/traitement.php", true);

    xhr.send(dataform);
    // create utudiant using ajax send request to data base etudiant
// ** get all student
// ** get datafrom and store in data base

}

//get all student from data base

// update student

function getAllEtudiant() {
    const xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = document.getElementById('res');
            res.hidden = false;
            displayEtudiants(JSON.parse(xhr.responseText));
        }
    });
    const dataform = new FormData();
    dataform.append("action", "afficherTous");
    xhr.open("POST", "./src/Contorllers/traitementMembre.php", true);
    xhr.send(dataform);
}

//
ajouter.addEventListener('click', (e) => {
    e.preventDefault();
    if (modefierIsClicked == false) {
        addSudent();
    } else {
        modifierEtudient();


    }
});

function displayEtudiants(arrayStudents) {
    listStudent.innerText = '';
    console.log(arrayStudents);
    arrayStudents.map((e) => {
        listStudent.append(createEtudiant(e));
    });
}

function createEtudiant(arrayEtudiant) {
    console.log(arrayEtudiant);
    let tr = document.createElement('tr');
    let th = document.createElement('th');
    th.scope = 'row';
    th.innerText = arrayEtudiant['id'];

    let td1 = document.createElement('td');
    td1.innerText = arrayEtudiant['nom'];

    let td2 = document.createElement('td');
    td2.innerText = arrayEtudiant['prenom'];

    let td3 = document.createElement('td');
    td3.innerText = arrayEtudiant['email'];

    let td4 = document.createElement('td');
    td4.innerText = arrayEtudiant['dateNaissance'];

    let td5 = document.createElement('td');
    td5.innerText = arrayEtudiant['filiere'];

    let td6 = document.createElement('td');
    let btn = document.createElement('button');
    btn.addEventListener('click', deleteStudent);
    td6.append(btn);
    btn.className = 'btn btn-danger';
    btn.innerText = 'supprimer';
    let btn1 = document.createElement('button');
    btn1.innerText = 'modifier';
    btn1.className = 'btn btn-primary';
    btn1.addEventListener('click', modifier);
    td6.append(btn, btn1);
    tr.append(th, td1, td2, td3, td4, td5, td6);
    return tr;
}

getAllEtudiant();


// delete student

function modifier(e) {
    modefierIsClicked = true;

    viewStudent(e);
}

function modifierEtudient() {
    const xhr = getXhr();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = document.getElementById('res');
            res.hidden = false;
            getAllEtudiant();
            if (xhr.responseText == 'success') {
                document.getElementById("succes").hidden = false;
                document.getElementById("succes").innerText = "Etudiant modifié avec succès";
                setTimeout(() => {
                    document.getElementById("succes").hidden = true;
                }, 3000);
            } else {
                document.getElementById("failed").hidden = false;
                document.getElementById("failed").innerText = "Erreur lors de la modification";
                setTimeout(() => {
                    document.getElementById("failed").hidden = true;
                }, 3000);

            }
        }
    });

    const dataform = new FormData(document.getElementById("formulaire"));


    dataform.append("action", "modifier");
    dataform.append('id', id.value);
    dataform.forEach((e) => {
        console.log(e);
    });
    xhr.open("POST", "./php/traitement.php", true);

    xhr.send(dataform);
    formulaire.reset();
    modefierIsClicked = false;
    // create utudiant using ajax send request to data base etudiant
}


function viewStudent(e) {
    let list = e.target.parentElement.parentElement.children;
    console.log(nom);
    nom.value = list[1].innerText;
    prenom.value = list[2].innerText;
    email.value = list[3].innerText;
    DOfbirth.value = list[4].innerText;
    filiere.value = list[5].innerText;
    id.value = list[0].innerText;
}