let p1 = document.createElement("p");
let p2 = document.createElement("p");
let pResultado = document.createElement("p");

let div1 = document.getElementById("primero");
let div2 = document.getElementById("segundo");
let divResultado = document.getElementById("resultado");

div1.appendChild(p1);
div2.appendChild(p2);
divResultado.appendChild(pResultado);

function genera() {
    
    let numeroAleatorio1 = Math.floor(Math.random() * 100);
    let numeroAleatorio2 = Math.floor(Math.random() * 100);

    if (p1.textContent === "" && p2.textContent === "") {

        let texto1 = document.createTextNode(numeroAleatorio1);
        let texto2 = document.createTextNode(numeroAleatorio2);

        p1.appendChild(texto1);
        p2.appendChild(texto2);

    } else if (p1.textContent === "") {

        let texto1 = document.createTextNode(numeroAleatorio1);
    
        p1.appendChild(texto1);

    } else if (p2.textContent === "") {

        let texto2 = document.createTextNode(numeroAleatorio2);

        p2.appendChild(texto2);
    }
}

function compara() {
    let numero1 = parseInt(p1.textContent);
    let numero2 = parseInt(p2.textContent);

    if (numero1 > numero2) {
        mover(p1);
        limpiarContenido(p1);
    } else if (numero1 < numero2) {
        mover(p2);
        limpiarContenido(p2);
    }
}

function limpiarContenido(elemento) {
    while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
    }
}

function mover(parrafo) {

    let numeroMayor = parrafo.textContent;
    let resultado = document.createTextNode(numeroMayor);

    if (pResultado.firstChild) {

        pResultado.replaceChild(resultado, pResultado.firstChild);

    } else {

        pResultado.appendChild(resultado);
    }
}


