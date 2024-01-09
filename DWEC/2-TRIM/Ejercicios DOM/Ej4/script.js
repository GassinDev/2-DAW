function anade() {
    //He creado este array para cuando le de a añadir un nuevo elemento
    //a la lista sea diferente al anterior gracias al random de este array.

    let titulosPeliculas = [
        "Titanic",
        "El Padrino",
        "La La Land",
        "Matrix",
        "Forrest Gump",
        "El Señor de los Anillos",
        "Pulp Fiction",
        "Coco",
        "Inception",
        "The Shawshank Redemption"
    ];

    let numeroAleatorio = Math.floor(Math.random() * titulosPeliculas.length);

    let lista = document.getElementById("lista");

    let nuevoLi = document.createElement("li");
    let textoNuevoLi = document.createTextNode(titulosPeliculas[numeroAleatorio]);

    nuevoLi.appendChild(textoNuevoLi);
    lista.appendChild(nuevoLi);
}