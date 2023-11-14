document.getElementById('formRegistro').addEventListener('submit', function(event) {

    event.preventDefault(); // Evitar que el formulario se envíe por defecto

    let correo = document.getElementById('correo').value;
    let dni = document.getElementById('dni').value;
    let contrasena = document.getElementById('contrasena').value;
    let telefono = document.getElementById('telefono').value;

    const correoRegex = /^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]+$/;
    const telefonoRegex = /^\+\d{2} \d{3}-\d{3}-\d{3}$/;
    const dniRegex = /^\d{8}[A-Z]$/;
    const contrasenaRegex = /^(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\-])(?=.*[A-Z])(?=.*[a-z])(?=.*\d{2,})$/;

    if (correoRegex.test(correo)) {
        alert("CORREO VÁLIDO");
    } else {
        alert("CORREO INVÁLIDO");
    }

    if (telefonoRegex.test(telefono)) {
        alert("TELÉFONO VÁLIDO");
    } else {
        alert("TELÉFONO INVÁLIDO, formato +XX XXX-XXX-XXX.");
    }

    if (dniRegex.test(dni)) {
        alert("DNI VÁLIDO");
    } else {
        alert("DNI INVÁLIDO, formato XXXXXXXX[A-Z]");
    }

    if (contrasenaRegex.test(contrasena)) {
        alert("CONTRASEÑA VÁLIDA");
    } else {
        alert("CONTRASEÑA INVÁLIDA, Lea bien la letra pequeña");
    }
});



