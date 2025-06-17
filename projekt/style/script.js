const butt = document.getElementById("butt");
const formula1 = document.getElementById("formula1");

butt.addEventListener("click", event => {

    if(formula1.style.display === "none"){
        formula1.style.display = "block";
    }
    else{
        formula1.style.display = "none";
    }
}
)

const butt2 = document.getElementById("butt2");
const formula2 = document.getElementById("formula2");

butt2.addEventListener("click", event => {

        if(formula2.style.display === "none"){
            formula2.style.display = "block";
        }
        else{
            formula2.style.display = "none";
        }
    }
)