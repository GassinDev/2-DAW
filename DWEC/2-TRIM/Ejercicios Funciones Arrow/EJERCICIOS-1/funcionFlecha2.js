// let  nombrar =codigo => codigo.split(':')[1]

// console.log(nombrar("12050:alejandro"))

let productos=[
    {nombre:"alejo",apellidos:'zamora',direccion:'calle 113'},
    {nombre:"maria",apellidos:'zamora',direccion:'calle 113'},
    {nombre:"stepha",apellidos:'zamora',direccion:'calle 113'},
    {nombre:"marce",apellidos:'zamora',direccion:'calle 113'}
]

productos.forEach(function(event){
    let nombre = document.createElement('h2')
    nombre.textContent=event.nombre
    console.log(event.nombre)
})