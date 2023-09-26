
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
    let fraseArrayLetras = frase.split('');
    let nPala = fraseArrayPalabras.length;
    let primeraPalabra = fraseArrayPalabras[0];
    let ultimaPalabra = fraseArrayPalabras[fraseArrayPalabras.length - 1];
    let fraseArrayPalabrasReves = fraseArrayPalabras.reverse();
    let fraseReverse = fraseArrayPalabrasReves.concat();

    for(let i = 0; i <= fraseArrayPalabras.length;i++){
        
    }

    alert(`Número de Palabras = ${nPala}`)
    alert(`Primera Palabra = ${primeraPalabra}, Última palabra = ${ultimaPalabra}`)
    alert(`Frase invertida = ${fraseReverse}`);

}