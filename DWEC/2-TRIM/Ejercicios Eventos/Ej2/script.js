document.addEventListener("mousemove", function(event) {

    let NavX = event.clientX;
    let NavY = event.clientY;

    let PageX = event.pageX;
    let PageY = event.pageY;
    document.getElementById("info").style.backgroundColor = "white";
    muestraInformacion(['Ratón', `Navegador [${NavX}, ${NavY}]`, `Pagina [${PageX},${PageY}]`]);
});

document.addEventListener("keydown", function(event) {
    
    let tecla = event.key;

    let codigo = tecla.charCodeAt(0);
    document.getElementById("info").style.backgroundColor = "#CCE6FF";
    muestraInformacion(['Teclado', `Carácter [${tecla}]`, `Pagina [${codigo}]`]);
});

document.addEventListener("mousedown", function(){
    
    document.getElementById("info").style.backgroundColor = "#FFFFCC";
});

function muestraInformacion(mensaje) {
    document.getElementById("info").innerHTML = '<h1>'+mensaje[0]+'</h1>';
    for(var i=1; i<mensaje.length; i++) {
        document.getElementById("info").innerHTML += '<p>'+mensaje[i]+'</p>';
    }
}

