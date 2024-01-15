let Enlaces = document.getElementsByTagName("a");
numEnl.innerHTML = "Número de enlaces = " + Enlaces.length;

dirUl.innerHTML = "Dirección del penúltimo enlace = " + Enlaces[Enlaces.length - 2].href;

let cont = 0;
for (let i = 0; i < Enlaces.length; i++) {

    if (Enlaces[i].href === "http://prueba" || Enlaces[i].href === "http://prueba/") {
        cont++;
    }
}

numEnlPrueba.innerHTML = "Numero de enlaces que enlazan a http://prueba = " + cont;
//
let cont2 = 0;
let Parrafos = document.getElementsByTagName("p");
let numEnlacesParra = Parrafos[2].getElementsByTagName("a");

enlParra3.innerHTML = "Numero de enlaces del tercer párrafo = " + numEnlacesParra.length;