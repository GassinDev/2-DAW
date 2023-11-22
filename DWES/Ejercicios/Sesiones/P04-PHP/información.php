<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Información</h1>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt, fuga! Facilis, voluptatum et magni dolore, porro est reiciendis similique labore in ab tempore eligendi. Nemo corporis nostrum ab vel repellat?<p>
<a href="index.php">Volver al login</a>
<?php
    //PARA ASIGNAR EL COLOR DE FONDO SI EXISTE LA COOKIE
    if (isset($_COOKIE['colorFondo'])){
        $color = $_COOKIE['colorFondo'];
        echo "<style>body { background-color: $color; }</style>";
    }
?>
</body>
</html>