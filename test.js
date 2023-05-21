function getAllMembres() {
    const xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let res = document.getElementById('res');
            res.hidden = false;
            console.log(JSON.parse(xhr.responseText));
            //displayEtudiants(JSON.parse(xhr.responseText));
        }
    });
    const dataform = new FormData();
    dataform.append("action", "afficherTous");
    xhr.open("POST", "./src/Contorllers/traitementMembre.php", true);
    xhr.send(dataform);
}