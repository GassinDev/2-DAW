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
    nombre : "Jose Aldo",
    edad : 20,
    guardia : true,
    pais : "Italia",
    area : "Designer",
    puesto: "Creative",
    sueldo: 1200,
    lenguajes: ["Java"],
    seniority: "Senior",
}]

document.write("<H1>Los que hacen guardia</H1>");
empleadosQueHacenGuardia(arrayEmpleado, lectorArray);
document.write("<br>");
document.write("<H1>Ordenados por país</H1>");
empleadosPorPais(arrayEmpleado, lectorArrayPorPais);
document.write("<br>");
document.write("<H1>Ordenados por area</H1>");
empleadosPorArea(arrayEmpleado, lectorArrayPorArea);
document.write("<br>");
document.write("<H1>Ordenados por sueldo</H1>");
empleadosConSueldoMayorA(arrayEmpleado,1000,lectorArrayPorSueldo);
document.write("<br>");
document.write("<H1>Ordenados por cantidad de lenguaje</H1>");
empleadosConMasLenguaje(arrayEmpleado,2,lectorArrayPorLenguajes);
document.write("<br>");
document.write("<H1>Promedio de los sueldos</H1>");
mostrarSueldoPromedio(arrayEmpleado,sueldoPromedioEmpleados);
document.write("<br>");
document.write("<H1>Promedio de los sueldos por seniority</H1>");
sueldoPromedioPorSeniority(arrayEmpleado,"Senior",mostrarSueldoPromedioSeniority);
document.write("<br>");


function lectorArray(arrayEmpleado){
    arrayEmpleado.forEach((empleado) => document.write(`<h2>Nombre: ${empleado.nombre}</h2>`)); 
}

function lectorArrayPorPais(arrayEmpleado){
    arrayEmpleado.forEach((empleado) => document.write(`<h2>Nombre: ${empleado.nombre}, País: ${empleado.pais}</h2>`)); 
}

function lectorArrayPorArea(arrayEmpleado){
    arrayEmpleado.forEach((empleado) => document.write(`<h2>Nombre: ${empleado.nombre}, Área: ${empleado.area}</h2>`)); 
}

function lectorArrayPorSueldo(arrayEmpleado){
    arrayEmpleado.forEach((empleado) => document.write(`<h2>Nombre: ${empleado.nombre}, Sueldo: ${empleado.sueldo}</h2>`)); 
}

function lectorArrayPorLenguajes(arrayEmpleado){
    arrayEmpleado.forEach((empleado) => document.write(`<h2>Nombre: ${empleado.nombre}, Lenguajes: ${empleado.lenguajes}</h2>`)); 
}

function mostrarSueldoPromedio(arrayEmpleado,callback){
    let promedioSueldo = callback(arrayEmpleado);
    document.write(`<H2>Hay un sueldo promedio de ${promedioSueldo}€</H2>`);
}

function mostrarSueldoPromedioSeniority(promedioSueldo){
    document.write(`<H2>Hay un sueldo promedio de ${(promedioSueldo).toFixed(2)}€</H2>`);
}

function empleadosQueHacenGuardia(arrayEmpleado, callback){
    let resultArray = arrayEmpleado.filter(empleado => empleado.guardia === true);
    callback(resultArray);
}

function empleadosPorPais(arrayEmpleado, callback){
    arrayEmpleado.sort((a,b) => a.pais.localeCompare(b.pais));
    callback(arrayEmpleado);
}

function empleadosPorArea(arrayEmpleado, callback){
    arrayEmpleado.sort((a,b) => a.area.localeCompare(b.area));
    callback(arrayEmpleado);
}

function empleadosConSueldoMayorA(arrayEmpleado, sueldo, callback){
    let resultArray = arrayEmpleado.filter(empleado => empleado.sueldo >= sueldo);
    resultArray.sort((a,b) => a.sueldo - b.sueldo);
    callback(resultArray);
}

function empleadosConMasLenguaje(arrayEmpleado, nLenguajes, callback){
    let resultArray = arrayEmpleado.filter(empleado => empleado.lenguajes.length > nLenguajes);
    callback(resultArray);
}

function sueldoPromedioEmpleados(arrayEmpleado){
    let sumaSueldos = 0;
    arrayEmpleado.forEach((empleado) => { sumaSueldos += empleado.sueldo});
    let promedioSueldo = sumaSueldos / arrayEmpleado.length;
    return promedioSueldo;
}

function sueldoPromedioPorSeniority(arrayEmpleado, seniority,callback){
    let resultArray = arrayEmpleado.filter(empleado => empleado.seniority === seniority);
    let sumaSueldos = 0;
    resultArray.forEach((empleado) => { sumaSueldos += empleado.sueldo});
    let promedioSueldo = sumaSueldos / resultArray.length;
    callback(promedioSueldo);
}

function buscarEmpleados(arrayEmpleado,area,puesto,seniority,callback){
    let resultArray = arrayEmpleado.filter(empleado => empleado.area === area
    && empleado.puesto === puesto && empleado.seniority === seniority);
    callback(resultArray);
}