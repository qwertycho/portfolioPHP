function filter(e){
    let projecten = document.getElementsByClassName("project");
    for(let i = 0; i < projecten.length; i++){
        if(projecten[i].getAttribute("techniek").includes(e)){
            projecten[i].style.display = "flex";
        }else{
            projecten[i].style.display = "none";
        }
    }
}

function urlFilter(url = window.location.href){
    let urlArray = url.split("=");
    let param = urlArray[urlArray.length - 1];
    if(param != "undefined" && !param.includes("projecten")){
        setOptions(param);
        filter(param);
    }
}

function setOptions(param){
    let options = document.querySelectorAll("option");
    for(let i = 0; i < options.length; i++){
        if(options[i].value == param){
            options[i].selected = true;
        } else {
            options[i].selected = false;
        }
    }
}

function setFilter(techniek){
    urlFilter("techniek=" + techniek);
}

urlFilter();