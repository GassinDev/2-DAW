for (let i = 0; i < 100; i++) {

    let checkbox = document.createElement("input");
    checkbox.type = "checkbox";

    let numeroAleatorio = Math.floor(Math.random() * 130);

    document.body.innerHTML += `${checkbox.outerHTML} ${numeroAleatorio}`;
}

function marcarTodas(){

    let checkboxes = document.getElementsByTagName("input");

    for (let i = 0; i < checkboxes.length; i++) {

        checkboxes[i].type = "checkbox";
        checkboxes[i].checked = true;
    }

}

function desmarcarTodas(){

    let checkboxes = document.getElementsByTagName("input");

    for (let i = 0; i < checkboxes.length; i++) {

        checkboxes[i].type = "checkbox";
        checkboxes[i].checked = false;
    }
}