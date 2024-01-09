<?php

if(isset($_GET['x'])) {

    $json = urldecode($_GET['x']);
    $datos = json_decode($json);

    if(isset($datos->nombre)) {
        echo "Nombre: " . $datos->nombre;
    }
}

?>
