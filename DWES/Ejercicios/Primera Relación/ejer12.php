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
    
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];

        $x;


        echo $x;
        

    ?>
</body>

</html>