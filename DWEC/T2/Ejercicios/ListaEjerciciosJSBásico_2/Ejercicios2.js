function comprobarCadena() {
    let cadena = document.getElementById("cadena").value;
    let constanteMinus = 0;
    let constanteMayus = 0;
    let cadenaArray = cadena.split("");
    let letrasMinusculasArray = "qwertyuiopasdfghjklñzxcvbnm".split("");
    let letrasMayusculasArray = "QWERTYUIOPASDFGHJKLÑZXCVBNM".split("");

    for (let i = 0; i < cadenaArray.length; i++) {
        for (let j = 0; j < letrasMinusculasArray.length; j++) {
            if (cadenaArray[i] === letrasMinusculasArray[j]) {
                constanteMinus++;
            }
        }

        for (let x = 0; x < letrasMayusculasArray.length; x++) {
            if (cadenaArray[i] === letrasMayusculasArray[x]) {
                constanteMayus++;
            }
        }
    }

    if ((constanteMinus > 0) & (constanteMayus > 0)) {
        alert("Compuesto por mayúsculas y minúsculas");
    } else if ((constanteMinus > 0) & (constanteMayus === 0)) {
        alert("Solo compuesto por minúsculas");
    } else {
        alert("Solo compuesto por mayúsculas");
    }
}

function ahorcado() {
    let variasPalabras = ["PELO", "COCHE", "JUEGO", "PELUCHE"];
    let nRandom = parseInt(Math.random() * 4);
    let intentos = 5;
    let aciertos = 0;
    let nLetra = 0;
    let palabra = variasPalabras[nRandom].split("");
    let formPala = [];

    for (let i = 0; i < formPala.length; i++) {
        formPala[i] = "X";
    }

    while (intentos > 0) {
        let letra = prompt(`Dime letras para intentar acertar la palabra (Te quedan ${intentos} intentos): ${formPala}`).toUpperCase();
        nLetra = 0;

        for (let i = 0; i < palabra.length; i++) {
            if (letra === palabra[i]) {
                nLetra++;
                aciertos++;
                formPala[i] = letra;

                alert("Acertaste, contiene esa letra.");
            }
        }

        if (aciertos === palabra.length) {
            break;
        }
        
        if (nLetra === 0) {
            intentos--;
            alert("¡Fallaste!");
        }
    }

    if (intentos === 0) {
        alert("Perdiste, te has quedado sin intentos.");
    } else {
        alert(`Correcto acertaste la palabra era ${variasPalabras[nRandom]}`);
    }
}
