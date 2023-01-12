function filter(e){
    let projecten = document.getElementsByClassName("project");
    for(let i = 0; i < projecten.length; i++){
        console.log(projecten[i].getAttribute("techniek").includes(e));
        if(projecten[i].getAttribute("techniek").includes(e)){
            console.log("test");
            projecten[i].style.display = "flex";
        }else{
            projecten[i].style.display = "none";
        }
    }
}

function urlFilter(url = window.location.href){
    let urlArray = url.split("=");
    let param = urlArray[urlArray.length - 1];
    console.log(param);
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
            console.log("val: " + options[i].value);
        }
    }
}

function resetFilter(){
    urlFilter("techniek=all")
}

function setFilter(techniek){
    urlFilter("techniek=" + techniek);
}

urlFilter();