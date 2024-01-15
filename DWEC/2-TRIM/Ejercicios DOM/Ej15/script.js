let a = document.getElementsByTagName("a");
let contador = 0;

for (let i = 0; i < a.length; i++) {

    if (a[i].href.includes("http")) {

        a[i].href = a[i].href.replace("http", "https");
    }

    if(a[i].getAttribute("class") === "importante"){
        a[i].setAttribute("name", "importante" + contador);
        contador++;
    }

}

let p = document.getElementsByTagName("p");

for (let i = 0; i < p.length; i++) {

    if (p[i].getAttribute("class") === "importante") {

        p[i].setAttribute("class", "resaltado");
    } else {

        p[i].setAttribute("class", "normal");
    }
}