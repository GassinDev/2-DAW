function calcularTiempo() {
  let fecha = new Date();

  let mesActual = fecha.getMonth() + 1;
  let diaActual = fecha.getDate();
  let horasActuales = fecha.getHours();
  let minutosActuales = fecha.getMinutes();
  let segundosActuales = fecha.getSeconds();

  let mesesRestantes = 12 - mesActual;
  let diasRestantes = 31 - diaActual;
  let horasRestantes = 24 - horasActuales;
  let minutosRestantes = 60 - minutosActuales;
  let segundosRectantes = 60 - segundosActuales;

  if (minutosRestantes > 0) {
    horasRestantes -= 1;
  }

  let milisegundosRestantes =
    mesesRestantes * 31 * 24 * 216000 +
    diasRestantes * 24 * 216000 +
    horasRestantes * 216000 +
    minutosRestantes * 3600 +
    segundosRectantes * 60;

  alert(
    `Quedan ${milisegundosRestantes} milisegundos restantes hasta fin de año.`
  );
}

function mostrar() {
  let pi = Math.PI;

  alert(pi.toFixed(4));
}

function tacharCursivar() {
  let cadena = prompt("Dime una cadena:");

  document.write(
    `<p><font size="10"><em><strike>${cadena}</strike></em></font></p>`
  );
}

let array = [];

function insertarPrincipio(array) {
  let nRandom = parseInt(Math.random() * 1001);

  array.unshift(nRandom);

  document.getElementById("array").innerHTML = array;
}

function insertarFinal(array) {
  let nRandom = parseInt(Math.random() * 1001);

  array.push(nRandom);
  document.getElementById("array").innerHTML = array;
}

function borrarPrimero(array) {
  array.shift();
  document.getElementById("array").innerHTML = array;
}

function borrarUltimo(array) {
  array.pop();
  document.getElementById("array").innerHTML = array;
}

function ordenAscendente(array) {
  array.sort();
  document.getElementById("array").innerHTML = array;
}

function ordenDescendente(array) {
  array.sort();
  array.reverse();
  document.getElementById("array").innerHTML = array;
}

