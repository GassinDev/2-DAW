<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $colores = array("rojo", "verde", "azul", "amarillo");

        sort($colores);

        echo "8. Los colores ordenados son ";
        for($i = 0; $i < count($colores);$i++){

            if(count(($colores)) - 1 === $i){
                echo "y {$colores[$i]}.";
            }else if(count(($colores)) - 2 === $i){
                echo "{$colores[$i]} ";
            }else{
                echo "{$colores[$i]}, ";
            }
        }

        
        rsort($colores);
        echo "9. Los colores ordenados al revés son ";
        
        for($i = 0; $i < count($colores);$i++){

            if(count(($colores)) - 1 === $i){
                echo "y {$colores[$i]}.";
            }else if(count(($colores)) - 2 === $i){
                echo "{$colores[$i]} ";
            }else{
                echo "{$colores[$i]}, ";
            }
        }

    ?>
</body>
</html>