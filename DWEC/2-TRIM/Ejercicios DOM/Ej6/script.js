let numP = document.getElementsByTagName("p");

let enlace = document.createElement("a");
enlace.href = 'http://www.iesromerovargas.com/';
enlace.textContent = '+ info';

numP[2].appendChild(enlace);

let nuevoP = document.createElement("p");
nuevoP.textContent = "Texto de ejemplo para el ejercicio.";
nuevoP.style.color = "red";

numP[2].parentNode.insertBefore(nuevoP, numP[3]);

numP[1].remove();
