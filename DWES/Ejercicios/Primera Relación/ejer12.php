<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="ejer12.php" method="post">
        <p>a<input type="number" name="a"></p>
        <p>b<input type="number" name="b"></p>
        <p>c<input type="number" name="c"></p>
        <p><input type="submit" value="Enviar"></p>
    </form>

    <?php

    if (isset($_POST["a"]) & isset($_POST["b"]) & isset($_POST["c"])) {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];

        $soluciones = resolver2grado($a, $b, $c);

        if($soluciones === false){
            echo "No tiene soluciones reales - ERROR";
        }else{
            foreach($soluciones as $i => $numero){
                $i += 1;
                echo "x$i = $numero<br>";
            }
    
        }
    }

    function resolver2grado($a, $b, $c)
    {
        $x1 = (-$b + sqrt((pow($b, 2) - (4 * $c * $a)))) / (2 * $a);
        $x2 = (-$b - sqrt((pow($b, 2) - (4 * $c * $a)))) / (2 * $a);

        if ($x1 === $x2) {
            $arrayX = array($x1);
            return $arrayX;
        } else {
            if (is_nan($x1) && is_nan($x2)) {
                return false;

            } elseif (is_nan($x1) === false && is_nan($x2) === false) {
                $arrayX = array($x1, $x2);
                return $arrayX;

            } else {

                if (is_nan($x1) && is_nan($x2) === false) {
                    $arrayX = array($x2);
                    return $arrayX;
                } else {
                    $arrayX = array($x1);
                    return $arrayX;
                }
            }
        }

    }

    
    ?>
</body>

</html>