function calculo() {

    let num1 = parseInt(document.getElementById("valor1").value);
    let num2 = parseInt(document.getElementById("valor2").value);

    let select = document.getElementById("operacion");
    let valorSelect = select.value;

    let p = document.getElementById("resultado1");

    if (valorSelect === "resta") {

        p.innerHTML = `La diferencia es ${num1 - num2}`;

    } else {

        p.innerHTML = `La suma es ${num1 + num2}`;
    }
}

function calculomultiple() {

    let num1 = parseInt(document.getElementById("valor1").value);
    let num2 = parseInt(document.getElementById("valor2").value);

    let select = document.getElementById("operaciones");
    let opciones = select.options;
    let valoresElegidos = [];

    let p = document.getElementById("resultado2");

    for (let i = 0; i < opciones.length; i++) {

        if (opciones[i].selected) {

            valoresElegidos.push(opciones[i].value);

        }
    }

    if(valoresElegidos.includes("suma") && valoresElegidos.includes("resta")){

        p.innerHTML = `La suma es ${num1 + num2} - La diferencia es ${num1 - num2}`;

    }else if(valoresElegidos.includes("suma")){

        p.innerHTML = `La suma es ${num1 + num2}`;

    }else{

        p.innerHTML = `La diferencia es ${num1 - num2}`;
        
    }


}