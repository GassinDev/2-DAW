function calcular() {

    let num1 = parseInt(document.getElementById("valor1").value);
    let num2 = parseInt(document.getElementById("valor2").value);

    let checkboxSuma = document.getElementById("suma");
    let checkboxResta = document.getElementById("resta");

    let p = document.getElementById("resultado");

    if (checkboxSuma.checked && checkboxResta.checked) {

        p.innerHTML = `La suma es ${num1 + num2} - La diferencia es ${num1 - num2}`;
        
    } else if (checkboxResta.checked) {

        p.innerHTML = `La diferencia es ${num1 - num2}`;

    } else if (checkboxSuma.checked) {

        p.innerHTML = `La suma es ${num1 + num2}`;

    }
}


