const numParametros = (...args) => `Le has pasado a la función un total de ${args.length} parámetros`;

console.log(numParametros('hola',2,5));
console.log(numParametros(1,2));
console.log(numParametros('a',2,5,6,'sábado'));
