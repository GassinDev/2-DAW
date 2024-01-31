const crearAprendiz = (nombre, planeta, edad, estatura, clasificarAprendiz) => {
    let datosAprendiz = {
        nombre: nombre, planeta: planeta, edad: edad, estatura: estatura

    }
    clasificarAprendiz(datosAprendiz)
}


// function crearAprendiz(nombre, planeta,edad,estatura,clasificarAprendiz){
//     let datosAprendiz={
//         nombre:nombre, planeta:planeta, edad:edad,estatura:estatura

//     }
//     clasificarAprendiz(datosAprendiz)


//     }
crearAprendiz('Alejo', 'tierra', 14, 1.63, function (clasifiaccion) {
    if (clasifiaccion.edad >= 15) {
        console.log('Usted se va para la clase sable de luz')
    } else {
        console.log('Usted se va para la clase de la fuerza')
    }
})