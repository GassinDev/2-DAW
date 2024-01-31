const fibonacci10primeros = () => {

    let arrayFibonacci = [];

    for (let i = 0; i < 10; i++) {

        if (i < 2) {
            arrayFibonacci.push(i);
        } else {
            let fibonacci = arrayFibonacci[i - 1] + arrayFibonacci[i - 2];
            arrayFibonacci.push(fibonacci);
        }

    }

    console.log(arrayFibonacci.join('-'));
}

fibonacci10primeros();