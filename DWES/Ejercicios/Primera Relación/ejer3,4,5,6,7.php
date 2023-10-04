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

    echo "4. La estatura de Alberto es {$estaturas["Alberto"]} cm.<br>";
    echo "5. Los pares son";
    
    foreach($estaturas as $posicion => $valor){
        if($valor % 2 == 0){
            echo " {$posicion} : {$valor} ,";
        }
    }
    echo "<br>";
    echo "6. ";

    asort($estaturas);

    foreach($estaturas as $posicion => $valor){
        echo "{$valor} ,";
    }

    echo "<br>";
    echo "7. ";

    foreach($estaturas as $posicion => $valor){
        echo "{$posicion} ,";
    }
?>
</body>

</html>