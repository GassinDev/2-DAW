let arrayEmpleado = [{
    nombre : "Juan José",
    edad : 20,
    guardia : true,
    pais : "España",
    area : "Backend",
    puesto: "Developer",
    sueldo: 1050,
    lenguajes: ["C#","Java","JS"],
    seniority: "Senior",
},
{
    nombre : "Luisa",
    edad : 21,
    guardia : false,
    pais : "Francia",
    area : "Frontend",
    puesto: "Developer",
    sueldo: 1000,
    lenguajes: ["Java","JS"],
    seniority: "Junior",
},
{
    nombre : "Pepe",
    edad : 24,
    guardia : true,
    pais : "España",
    area : "Backend",
    puesto: "Developer",
    sueldo: 950,
    lenguajes: ["C#"],
    seniority: "Senior",
},
{
    nombre : "Juan José",
    edad : 20,
    guardia : true,
    pais : "Italia",
    area : "Designer",
    puesto: "Creative",
    sueldo: 1200,
    lenguajes: ["Java"],
    seniority: "Senior",
}]

empleadosQueHacenGuardia(arrayEmpleado);

function empleadosQueHacenGuardia(arrayEmpleado){
    let resultArray = arrayEmpleado.filter(empleado => empleado.guardia === true);
    console.log(resultArray);
}

function empleadosPorPais(){

}

function empleadosPorArea(){

}

function empleadosConSueldoMayorA(){

}

