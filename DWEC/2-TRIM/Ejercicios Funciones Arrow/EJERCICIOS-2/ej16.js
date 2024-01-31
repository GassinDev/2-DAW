const numAleatorio = (min = 1, max = 100) => Math.floor(Math.random() * (max - min + 1)) + min;

console.log(numAleatorio(66,70));
console.log(numAleatorio());
console.log(numAleatorio(89));
