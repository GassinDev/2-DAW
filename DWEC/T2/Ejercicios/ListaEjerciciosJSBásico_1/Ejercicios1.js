
function mostrar(){

    for(let i = 1; i <= 6;i++){
        document.write(`<h${i}>Javascript</h${i}>`);
    }
}

function factorial(){
    
    let num = parseInt(document.getElementById("number").value);
    let facto = 1;

    for(let i = 1; i <= num;i++){
        facto = facto * i;
    }

    alert(`El factorial de ${num} es ${facto}.`);
}

function datosFrases(){
    
    
    let frase = prompt("Dime la frase:");
    
    let fraseArrayPalabras = frase.split(' ');
    let nPala = fraseArrayPalabras.length;
    let primeraPalabra = fraseArrayPalabras[0];
    let ultimaPalabra = fraseArrayPalabras[fraseArrayPalabras.length - 1];
    let fraseArrayPalabrasReves = fraseArrayPalabras.reverse();
    let fraseReverse = fraseArrayPalabrasReves.join(' ');
    let fraseLetrasOrdenadas = (((fraseArrayPalabras.join('')).split('')).sort()).join(',');


    alert(`Número de Palabras = ${nPala}`)
    alert(`Primera Palabra = ${primeraPalabra}, Última palabra = ${ultimaPalabra}`)
    alert(`Frase invertida = ${fraseReverse}`);
    alert(`Letras ordenadas a-z = ${fraseLetrasOrdenadas}`);
    alert(`Letras ordenadas z-a = ${(((fraseLetrasOrdenadas).split(',')).reverse()).join(',')}`);
}

function comprobarDNI(){

    let letrasDNI = "TRWAGMYFPDXBNJZSQVHLCKE";
    let letrasDNIArray = letrasDNI.split('');
    
    let dniNum = parseInt(document.getElementById("dni").value);
    let dniLetra = document.getElementById("letra").value;

    let calculoLetra = dniNum % 23;

    if(dniLetra === letrasDNIArray[calculoLetra]){
        alert("DNI válido");
    }else{
        alert("DNI inválido");
    }
}

function cambiarRojo(){
    document.getElementById("parrafo").style.color = "red";
}

function cambiarVerde(){
    document.getElementById("parrafo").style.color = "green";
}

function cambiarRosa(){
    document.getElementById("parrafo").style.color = "pink";
}

function cambiarAzul(){
    document.getElementById("parrafo").style.color = "blue";
}

function cambiarAmarillo(){
    document.getElementById("parrafo").style.color = "yellow";
}