<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $cadena="Esto es un string de varias palabras";

        $nCaracteres = strlen($cadena);
        $nPalabras = str_word_count($cadena);

        echo "Número de carácteres = $nCaracteres<br>";
        echo "Número de palabras = $nPalabras<br>";
        
        $mayusCadena = strtoupper($cadena);

        echo "Cadena en mayúscula = $mayusCadena";

    ?>
</body>
</html>