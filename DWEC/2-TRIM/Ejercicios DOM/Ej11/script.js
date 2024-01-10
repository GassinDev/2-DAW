function anade() {
    //He creado este array para cuando le de a añadir un nuevo elemento
    //a la lista sea diferente al anterior gracias al random de este array.

    let numeroAleatorio = Math.floor(Math.random() * 20);

    let lista = document.getElementById("lista");

    let nuevoLi = document.createElement("li");
    let textoNuevoLi = document.createTextNode(numeroAleatorio);

    nuevoLi.appendChild(textoNuevoLi);
    lista.appendChild(nuevoLi);
}