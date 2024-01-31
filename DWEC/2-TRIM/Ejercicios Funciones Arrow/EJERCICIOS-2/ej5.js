const DeciaBina = (num) => {

    let binario = [];
    let copiaNum = num;

    while (num > 0) {
        let resto = num % 2;
        binario.push(resto);
        num = Math.floor(num / 2);
    }

    binario.reverse();

    console.log(`El número ${copiaNum} en binario es ${binario.join('')}`);
}

DeciaBina(7);
DeciaBina(10);
DeciaBina(20);