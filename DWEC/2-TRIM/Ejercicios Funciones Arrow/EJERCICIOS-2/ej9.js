const primeros20pares = () => {
    
    let arrayPares = [];

    for(let i = 0; arrayPares.length < 20; i++){    
        if(i % 2 === 0){
            arrayPares.push(i);
        }
    }

    console.log(arrayPares.join('-'));
}

primeros20pares();