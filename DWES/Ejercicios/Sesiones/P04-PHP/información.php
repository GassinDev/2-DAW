<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Información</h1>
<a href="index.php">Volver al login</a>
<?php
    if ($_COOKIE['colorFondo']) {
        $color = $_COOKIE['colorFondo'];
        echo "<style>body { background-color: $color; }</style>";
    }
?>
</body>
</html>