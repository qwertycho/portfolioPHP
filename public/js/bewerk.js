async function update(id){
    let naam = document.getElementById('projectNaam').innerHTML;

    let techniek1 = document.getElementById('projectTechniek1').value;
    let techniek2 = document.getElementById('projectTechniek2').value;
    let techniek3 = document.getElementById('projectTechniek3').value;

    let omschrijving = document.getElementById("omschrijving").innerHTML

    let project = {
        id: id,
        naam: naam,
        techniek: [techniek1, techniek2, techniek3],
        omschrijving: omschrijving,
    }

    console.log(project);
    await fetchBoy("update", project);
}


async function yeet(id){
    id = { id: id };
    fetchBoy("delete", id);
}

async function fetchBoy(action, project){
    let link = "";
    if(action == "update"){
        link = "/admin/bewerk/update";
    } else{
        link = "/admin/bewerk/delete"
    }

    fetch(link, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(project)
    })
    .then(response => response.json())
    .then(data => {
        if(data.status == "ok"){
            location.reload();
        } else{
            alert(data.message);
        }
    })

}