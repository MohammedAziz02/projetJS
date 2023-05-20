export default function getXhr() {
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
  
const xhr=getXhr();

//ajouter les etudiants
function addStudent(){
    xhr.addEventListener("readystatechange",()=>{
        if(xhr.readyState==4 && xhr.status===200){
            console.log(xhr.responseText);
            if(xhr.responseText=="success"){
                success.hidden=false;
            }
            else if(xhr.responseText=="error") failed.hidden=false;
        }
    })
    const formData=new FormData(document.getElementById("formulaire"));
    formData.append("action",'ajouter');
    xhr.open("POST","./php/traitement.php",true);
    xhr.send(formData);


}

//get all students

function getAllStudents(){
    xhr.addEventListener("readystatechange",()=>{
        if(xhr.readyState==4 && xhr.status===200){
            var students=JSON.parse(xhr.responseText);
            listStudent.innerText="";
            students.map((e)=>{
                listStudent.append(createStudent(e));
            })

        }
    })
    const formData=new FormData();
    formData.append("action",'afficherTous');
    xhr.open("POST","./php/traitement.php",true);
    xhr.send(formData);

}

function createStudent(student){
    let tr=document.createElement("tr");
    let td1=document.createElement("td");
    td1.innerText=student['id'];
    let td2=document.createElement("td");
    td2.innerText=student['nom'];
    let td3=document.createElement("td");
    td3.innerText=student['prenom'];
    let td4=document.createElement("td");
    td4.innerText=student['email'];
    let td5=document.createElement("td");
    td5.innerText=student['dateNaissance'];
    let td6=document.createElement("td");
    td6.innerText=student['filiere'];
    let td7=document.createElement("td");
    //td7.innerHTML=`<button class='btn btn-primary mx-1 onclick='updateStudent''>Modifier</button><button class='btn btn-danger' onclick=${deleteStudent}>Supprimer</button>`
    let btn=document.createElement("button");
    let modifierbtn=document.createElement("button");
    btn.className="btn btn-danger";
    btn.innerText='supprimer';
    btn.addEventListener("click",deleteStudent);

    modifierbtn.className="btn btn-primary";
    modifierbtn.innerText='modifier';
    modifierbtn.addEventListener("click",updateStudent);
    td7.append(btn);
    td7.append(modifierbtn);
    tr.append(td1,td2,td3,td4,td5,td6,td7);
    return tr;

}
// modification d etudiant

function updateStudent(e){
    isModified=true;
    const elem=e.target.parentElement.parentElement.children;
    console.log(elem[1].innerText);
    //const nom=document.getElementById("nom");
    nom.value=elem[1].innerText;
    prenom.value=elem[2].innerText;
    email.value=elem[3].innerText;
    DOfbirth.value=elem[4].innerText;
    filiere.value=elem[5].innerText;
    if(xhr.readyState==4 && xhr.status===200){
        console.log(xhr.responseText);
    }
    const formData=new FormData(document.getElementById("formulaire"));
    formData.append("id",elem[0].innerText)
    formData.append("action",'modifier');
    xhr.open("POST","./php/traitement.php",true);
    xhr.send(formData);
    getAllStudents();
        
}


//suppression de l element
function deleteStudent(e){
    const elem=e.target.parentElement.parentElement.firstChild;
    if(xhr.readyState==4 && xhr.status===200){
    }
    const formData=new FormData();
    formData.append("id",elem.innerText)
    formData.append("action",'supprimer');
    xhr.open("POST","./php/traitement.php",true);
    xhr.send(formData);
    getAllStudents();
}

// boutton de clique
ajouter.addEventListener("click",(e)=>{
    e.preventDefault();
    if(isModified) updateStudent();
    else addStudent();
    isModified=false;
    getAllStudents();
});
getAllStudents();
