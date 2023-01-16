const projectForm = document.getElementById("projectForm");
const projectFormSubmit = document.getElementById("projectFormSubmit");

const techniekForm = document.getElementById("techniekForm");
const techniekFormSubmit = document.getElementById("techniekFormSubmit");

let xhr = new XMLHttpRequest();
    xhr.open("GET", "request.php?action=techniek", true);
    xhr.send();
    xhr.onload = function(){
    let data = JSON.parse(this.responseText);
    data.forEach(element => {
            for(let i = 0; i < document.querySelectorAll(".techniekSelector").length; i++){
                let option = document.createElement("option");
                option.value = element.techniekClass;
                option.innerHTML = element.techniekNaam;
                document.querySelectorAll(".techniekSelector")[i].appendChild(option);
            }
    });
}

projectFormSubmit.addEventListener("click", function(event){
    event.preventDefault();
    let technieken = [];
    for(let i = 0; i < select.length; i++){
        if(select.options[i].selected && select.options[i].value != "geen"){
            technieken.push(select.options[i].value);
        }
    }
    let project = {
        action: "project",
        titel: document.getElementById("projectTitel").value,
        projectTechniek: technieken,
        projectUrl: document.getElementById("projectLink").value,
        projectRepo: document.getElementById("projectRepo").value,
        projectImage: document.getElementById("projectImg").value,
        projectOmschrijving: document.getElementById("projectOmschrijving").value,
        projectDatum: document.getElementById("projectDatum").value,
        projectEindDatum: document.getElementById("projectEindDatum").value
    }
    console.log(project);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "upload.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(project));
    xhr.onload = function(){
        console.log(xhr.responseText);
    }
});

techniekFormSubmit.addEventListener("click", function(event){
    event.preventDefault();
    let techniek = {
        action: "techniek",
        techniekNaam: document.getElementById("techniekNaam").value,
        techniekClass: document.getElementById("techniekClass").value
    }
    console.log(techniek);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "upload.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(techniek));
    xhr.onload = function(){
        console.log(xhr.responseText);
    }
});