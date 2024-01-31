const calculadorPrecio = (precio,iva = 21) => `Tu precio con ${iva}% de IVA incluido es ${precio*(1 + (iva/100))}`;

console.log(calculadorPrecio(10,15));