for (let i = 1; i <= 3; i++) {
    document.getElementById(`enlace_${i}`).addEventListener("click", () => mostraOcultar(i));
}

function mostraOcultar(num) {

    let p = document.getElementById(`contenidos_${num}`);
    let a = document.getElementById(`enlace_${num}`)

    if (p.style.display === "none") {
        p.style.display = "inline";
        a.textContent = "Ocultar contenidos";
    } else {
        p.style.display = "none";
        a.textContent = `contenido ${num}`;
    }
}
