let tabla = document.createElement("table");
tabla.setAttribute("border",1);
let contador = 0;

for (let i = 0; i < 100; i++) {
    let fila = document.createElement("tr");

    
    for (let j = 1; j <= 100; j++){

        let bloque = document.createElement("td");
        bloque.textContent = j + contador;

        fila.appendChild(bloque);

    }

    tabla.appendChild(fila);

    contador += 100;
    
}

document.body.appendChild(tabla);
    
function marcarCasiPrimos(){


    let tabla = document.getElementsByTagName("table");
    let td = document.getElementsByTagName("td");

    for (let i = 0; i < 100; i++) {

        for (let j = 1; j <= 100; j++){
    
        }
    }
    

}