<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Información</h1>
<p>Lorem fistrum ese que llega no te digo trigo por no llamarte Rodrigor llevame al sircoo se calle ustée. 
    Amatomaa jarl va usté muy cargadoo qué dise usteer a gramenawer no te digo trigo por no llamarte Rodrigor.<p>
<a href="index.php">Volver al login</a>
<?php
    //TO ASSIGN THE BACKGROUND COLOR IF THE COOKIE EXISTS
    if (isset($_COOKIE['colorFondo'])){
        $color = $_COOKIE['colorFondo'];
        echo "<style>body { background-color: $color; }</style>";
    }
?>
</body>
</html>