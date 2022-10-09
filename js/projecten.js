function filter(e){
    console.log(e);
    let projecten = document.getElementsByClassName("project");
    for(let i = 0; i < projecten.length; i++){
        if(projecten[i].classList.contains(e)){
            projecten[i].style.display = "flex";
        }else{
            projecten[i].style.display = "none";
        }
    }
}

function urlFilter(){
    let url = window.location.href;
    let urlArray = url.split("=");
    let param = urlArray[urlArray.length - 1];
    console.log(param);
    if(param != "undefined" && !param.includes("projecten")){
        filter(param);
    }
}

urlFilter();


