function comprobarCadena(){

    let cadena = document.getElementById("cadena").value;
    let constanteMinus = 0;
    let constanteMayus = 0;
    let cadenaArray = cadena.split('');
    let letrasMinusculasArray = ("qwertyuiopasdfghjklñzxcvbnm").split('');
    let letrasMayusculasArray = ("QWERTYUIOPASDFGHJKLÑZXCVBNM").split('');

    for(let i = 0; i < cadenaArray.length;i++){

        for(let j = 0; j < letrasMinusculasArray.length;j++){
            if(cadenaArray[i] === letrasMinusculasArray[j]){
                constanteMinus++;
            }  
        }

        for(let x = 0; x < letrasMayusculasArray.length;x++){
            if(cadenaArray[i] === letrasMayusculasArray[x]){
                constanteMayus++;
            } 
        }
    }

    if(constanteMinus > 0 & constanteMayus > 0){
        alert("Compuesto por mayúsculas y minúsculas");
    }else if(constanteMinus > 0 & constanteMayus === 0){
        alert("Solo compuesto por minúsculas");
    }else{
        alert("Solo compuesto por mayúsculas");
    }
}