function comprobar(){

    let email = document.getElementById("email").value;
    let url = document.getElementById("url").value;

    let r1 = document.getElementById("resultado1");
    let r2 = document.getElementById("resultado2");

    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let regexUrl = /^(https?:\/\/www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(\/[a-zA-Z0-9-._~:/?#[\]@!$&'()*+,;=%]*)?$/

}