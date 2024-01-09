function calcularCaracteres() {
    
    let areaTexto = document.getElementById("comentarios");
    let numMaxCara = parseInt(areaTexto.getAttribute("maxlength"));
    let contador = document.getElementById("resultado");

    let caracteresRestan = numMaxCara - areaTexto.value.length;

    contador.textContent = caracteresRestan;
}




