let stringJSON = '{"nombre": "Mario", "apellidos": "Sánchez López", "nacido": "26-11-1986", "curso": "DAW2", "asignatura": "DEWC", "ciudad": "El Puerto de Santa María"}';

let datosAlumno = JSON.parse(stringJSON);

let fechaNacimiento = datosAlumno.nacido.split('-');
let fecha = new Date(fechaNacimiento[2], fechaNacimiento[1] - 1, fechaNacimiento[0]);

let valoresDatosAlumno = "Nombre: " + datosAlumno.nombre + ", " +
    "Apellidos: " + datosAlumno.apellidos + ", " +
    "Nacido: " + fecha + ", " +
    "Curso: " + datosAlumno.curso + ", " +
    "Asignatura: " + datosAlumno.asignatura + ", " +
    "Ciudad: " + datosAlumno.ciudad;

document.getElementById('datosAlumno').innerText = valoresDatosAlumno;

