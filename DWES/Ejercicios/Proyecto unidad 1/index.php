<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="index.php"><h1>TIENDA DE GASSINDEV</h1></a>

    <form method="post" action="index.php">
        <input type="submit" name="action" value="INSERTAR">
        <input type="submit" name="action" value="MODIFICAR">
        <input type="submit" name="action" value="BORRAR">
    </form><br>
    <?php
    include('function.php');

    //Vemos que ha usado alguno de los botones y si es así lo clasificamos según el valor
    if (isset($_POST['action'])) {

        $action = $_POST['action'];

        if ($action === 'INSERTAR') {
            echo showFormInsert();
            echo "<br>";
        } elseif ($action === 'MODIFICAR') {
            showFormModify();
            echo "<br>";
        } elseif ($action === 'BORRAR') {
            showFormDelete();
            echo "<br>";
        }
    }

    if (insert()) {
        echo "<h2>Producto añadido con éxito</h2>";
    } 

    if (delete()) {
        echo "<h2>Producto eliminado con éxito</h2>";
    } 

    if(modify()){
        echo "<h2>Producto modificado con éxito</h2>";
    }

    showList();
    ?>
</body>

</html>