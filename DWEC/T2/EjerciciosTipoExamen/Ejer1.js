let segundos = 5;

function crearJuego(){
    document.write("<h1>Consigue clickar sobre todos los números primos</h1>");
    document.write("<span id='tiempo' style='font-size:20px'></span><br>");
    for(let i = 1; i <= 50;i++){
        if(i < 10){
            document.write(`<input type="button" style='min-width:32px'id='${i}' value='0${i}' onclick='comprobarPrimo(${i})'></input>`);
        }else if(i % 10 === 0){
            document.write(`<input type="button" style='min-width:32px' id='${i}' value='${i}' onclick='comprobarPrimo(${i})'></input><br>`);
        }else{
            document.write(`<input type="button" style='min-width:32px' id='${i}' value='${i}' onclick='comprobarPrimo(${i})'></input>`);
        }
    }
    setInterval(temporizador,1000);
}

function comprobarPrimo(numero){

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
        document.getElementById(numero).value = "__";
    }else{
        document.getElementById(numero).style.backgroundColor = "red";
    }
}


function temporizador(){
    segundos--;
    document.getElementById("tiempo").innerHTML = `Temporizador : ${segundos} segundos`;
    if(segundos === -1){
        alert("Lo siento, se le ha acabado el tiempo.");
        window.location.reload();
    }
}
