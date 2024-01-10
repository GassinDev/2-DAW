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
    
function esCasiPrimo(num) {
    let contador = 0;

    for (let i = 1; i <= num; i++) {
        if (num % i === 0) {
            contador++;
        }
    }

    if (contador === 3) {
        return true;
    } else {
        return false;
    }
}

function marcarCasiPrimos() {
    
    let tdElements = document.querySelectorAll("table td");

    tdElements.forEach((td) => {

        let value = parseInt(td.textContent);

        if (esCasiPrimo(value)) {

            td.style.backgroundColor = "yellow";
        }
    });
}