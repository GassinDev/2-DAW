let numEnlaces = document.getElementsByTagName("a");
numEnl.innerHTML = "Número de enlaces = " + numEnlaces.length;

dirUl.innerHTML = "Dirección del penúltimo enlace = " + numEnlaces[numEnlaces.length - 2].href;

let cont = 0;
for (let i = 0; i < numEnlaces.length; i++) {

    if (numEnlaces[i].href == "http://prueba" || numEnlaces[i].href == "http://prueba/") {
        cont++;
    }
}

numEnlPrueba.innerHTML = "Numero de enlaces que enlazan a http://prueba = " + cont;

let cont2 = 0;
let numParra = document.getElementsByTagName("p");
let numEnlacesParra = numParra[2].getElementsByTagName("a");

enlParra3.innerHTML = "Numero de enlaces del tercer párrafo = " + numEnlacesParra.length;