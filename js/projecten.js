function filter(e){
    console.log(e);
    var projecten = document.getElementsByClassName("project");
    for(var i = 0; i < projecten.length; i++){
        if(projecten[i].classList.contains(e)){
            projecten[i].style.display = "flex";
        }else{
            projecten[i].style.display = "none";
        }
    }
}