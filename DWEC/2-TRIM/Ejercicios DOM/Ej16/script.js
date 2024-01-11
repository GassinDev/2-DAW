function genera() {
        
    let numeroAleatorio1 = Math.floor(Math.random() * 20);
    let numeroAleatorio2 = Math.floor(Math.random() * 20);

    let p1 = document.createElement("p");
    let p2 = document.createElement("p");

    let div1 = document.getElementById("primero");
    let div2 = document.getElementById("segundo");

    p1.textContent = numeroAleatorio1;
    p2.textContent = numeroAleatorio2;

    div1.appendChild(p1);
    div2.app(p2);

}

function compara() {

}