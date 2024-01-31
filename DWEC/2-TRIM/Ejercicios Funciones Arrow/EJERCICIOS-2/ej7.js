const media = (array) => {

    let sumatorio = 0;

    array.forEach((numero) => {
        sumatorio += numero;
    });

    let media = sumatorio / array.length;
    console.log(`La media de los número del array es ${media}.`);
}

media([2,4,6,1,1,5,7]);
media([1,2,3]);