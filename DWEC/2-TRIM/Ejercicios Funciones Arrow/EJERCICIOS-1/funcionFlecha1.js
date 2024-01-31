 
//  1.PROBLEMA: Yoda el maestro jedi, necesita enseñar a sus aprendices
//  Padawan a calcular la distancia a la que cualquiera de los planetas de la
//  ruta N-14 pertenecientes a la ruta comercial de la federación
//  intergaláctica, se encuentra del planeta NABOO.
//  Para calcular dicha distancia se debe:
//  • Recibir las coordenadas X,Y del planeta en UA
//  • Establecer la distancia como:
 
 
 // Declarando una funcion que calcule la distancia entre dos puntos
let calcularDistancia = (x1,y1,x2,y2)=> Math.sqrt(Math.pow(x2-x1,2) + Math.pow(y2-y1,2))

// Llamar la funcion

let distancia = calcularDistancia(0,0,12,0)
console.log(`la distancia calculada fue ${distancia}`)
