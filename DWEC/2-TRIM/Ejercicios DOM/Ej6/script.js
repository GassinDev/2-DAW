let P = document.getElementsByTagName("p");

let enlace = document.createElement("a");
enlace.href = 'http://www.iesromerovargas.com/';
enlace.textContent = '+ info';

P[2].appendChild(enlace);

let nuevoP = document.createElement("p");
nuevoP.textContent = "Texto de ejemplo para el ejercicio.";
nuevoP.style.color = "red";

P[2].parentNode.insertBefore(nuevoP, P[3]);

P[1].remove();
