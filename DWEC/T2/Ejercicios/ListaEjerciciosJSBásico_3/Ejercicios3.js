function calcularTiempo(){

    let fecha = new Date();

    let mesActual = fecha.getMonth()+1;
    let diaActual = fecha.getDate();
    let horasActuales = fecha.getHours();

    let mesesRestantes = 12 - mesActual;
    let diasRestantes = 31 - diaActual;

    alert(`Quedan ${diasRestantes} días, ${mesesRestantes} meses. ${horaActuales}`)
}

function mostrar(){

let pi = Math.PI;
1695944041477
    alert((pi).toFixed(4));
}