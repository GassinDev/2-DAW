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

        resolver2grado($a,$b,$c);
    }

    function resolver2grado ($a,$b,$c){
        $x1 = ((-1 * $b) + sqrt((pow($b, 2) - (4 * $c * $a)))) / (2 * $a);
        $x2 = ((-1 * $b) - sqrt((pow($b, 2) - (4 * $c * $a)))) / (2 * $a);

        if(is_nan($x1) & is_nan($x2)){
            echo "ERROR";
        }else{
            $arrayX = array($x1,$x2);
            
            echo "x [";

            for($i= 0; $i < count($arrayX); $i++) { 

                if($i === count($arrayX) - 1){
                    echo " {$arrayX[$i]}]" ;
                }else{
                    echo "{$arrayX[$i]} ," ;
                }
                
            }
        }
    }
    ?>
</body>

</html>