<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1>TIENDA DE GASSINDEV</h1>
    <?php
        include("function.php");
    ?>
</head>

<body>
    <?php
        echo showList();
    ?>
    <form action="function.php" method="post">
        <input type="button" value="Meter producto en mi lista"><br>
        <input type="button" value="Modificar">
    </form>
</body>

</html>