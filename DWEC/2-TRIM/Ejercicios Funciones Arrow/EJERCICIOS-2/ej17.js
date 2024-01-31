const mostrar100numAleatorios = () => {

    let arrayNum = [];

    for (let i = 0; i < 100; i++) {

        let numAleatorio = Math.floor(Math.random() * 1000) + 1;
        
        while(arrayNum.includes(numAleatorio)){
            numAleatorio = Math.floor(Math.random() * 1000) + 1;
        }

        arrayNum.push(numAleatorio);
    }

    console.log(arrayNum.join('-'));
}

mostrar100numAleatorios();