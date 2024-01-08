const miObjeto = {
    nombre: "Mario",
    apellidos: "Sánchez López",
    edad: 26,
    curso: "DAW2",
    asignatura: "DEWC",
    ciudad: "El Puerto de Santa María"
};

const myJSON = JSON.stringify(miObjeto);

document.getElementById("demo").innerText = miObjeto.nombre;

window.location = "demo_json.php?x=" + myJSON;





