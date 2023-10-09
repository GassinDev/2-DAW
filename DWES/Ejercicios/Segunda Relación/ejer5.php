<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $numero = "3452";

        $n = 0;

        for($i = 0; $i < strlen($numero);$i++){
            $n += $numero[$i];
        }

        echo $n;
    ?>
</body>
</html>