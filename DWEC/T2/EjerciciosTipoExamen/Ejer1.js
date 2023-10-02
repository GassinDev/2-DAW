function crearJuego(){
    document.write("<h1>Consigue clickar sobre todos los números primos</h1>")
    for(let i = 1; i <= 50;i++){
        if(i < 10){
            document.write(`<input type="button" id='${i}' value='0${i}' onclick='comprobarPrimo(${i})'></input>`);
        }else if(i % 10 === 0){
            document.write(`<input type="button" id='${i}' value='${i}' onclick='comprobarPrimo(${i})'></input><br>`);
        }else{
            document.write(`<input type="button" id='${i}' value='${i}' onclick='comprobarPrimo(${i})'></input>`);
        }
    }
}

function comprobarPrimo(numero){
    document.getElementById("numero").style.color = "red";
    let esPrimo = true;

    if (numero <= 1) {
            esPrimo = false;
        }
        
    for (let i = 2; i < numero; i++) {
        if (numero % i === 0) {
            esPrimo = false;
        }
    }

    if(esPrimo){
        
    }
}