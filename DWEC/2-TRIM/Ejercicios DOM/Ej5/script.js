function enviarSaludo(){

    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;

    let saludo = document.getElementById("saludo");
    saludo.innerHTML = `Hola ${nombre} ${apellido}, gracias por rellenar el formulario`;
}