<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    /*  3. Crea un array asociativo llamado $estaturas que contenga la estatura de las siguientes personas:

        4. Escribe el código necesario para mostrar la estatura de Alberto.

        5. Recorre el array asociativo estaturas y muestra los pares clave/valor.

        6. Ordena el array asociativo $estaturas en orden descendente de acuerdo al valor.

        7. Ordena el array asociativo $estaturas en orden descendente de acuerdo a la clave.*/

    $estaturas = [
        "Juan" => 186,
        "Alberto" => 172,
        "Marta" => 173
    ];

    echo "La estatura de Alberto es {$estaturas["Alberto"]} cm.<br>";
    echo "Los pares son";

    $tamañoArray = count($estaturas);

    foreach($estaturas as $posicion => $valor){
        if($valor % 2 == 0){
            echo " {$estaturas[$posicion]} ,";
        }
    }
?>
</body>

</html>