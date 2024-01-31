const comprobadorDNI = (dni) => {

    let esValido = false;
    let dniSinLetra = dni.slice(0,-1);
    let numLetra = dniSinLetra % 23;
    let letraDNI = dni[dni.length - 1];

    const letras = 'TRWAGMYFPDXBNJZSQVHLCKE';

    if(letraDNI === letras[numLetra]){
        esValido = true;
    }

    if(esValido){
        console.log(`El dni ${dni} es válido.`);
    }else{
        console.log(`El dni ${dni} no es válido.`);
    }


}

comprobadorDNI('12345678Z');
comprobadorDNI('32647283C');