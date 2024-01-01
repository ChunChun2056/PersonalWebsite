
const nameOfElement = document.querySelector(".nav-items")
var dd = "closed"
function dropdown(){
    nameOfElement.style.display="flex";
    if(dd == "closed"){
        nameOfElement.style.display="block";
        dd="opened";
    }
    else{
        nameOfElement.style.display="none";
        dd="closed";
    }
}