function ocultar(parrafo) {
    parrafo.classList.add("oculto");
}

function eliminar(parrafo){
    parrafo.remove();
}

function reaparecer() {
    let parrafos = document.getElementsByTagName("p");

    for (let i = 0; i < parrafos.length; i++) {
        parrafos[i].classList.remove("oculto");
    }
}

