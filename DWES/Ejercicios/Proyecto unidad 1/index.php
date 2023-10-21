<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <a href="index.php">
        <h1>TIENDA DE GASSINDEV</h1>
    </a>

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

    if (isset($_POST["name"])) {
        if (insert()) {
            echo "<h2>Producto añadido con éxito</h2>";
        } else {
            echo "<h2>Producto no añadido- ERROR: Ya se encontró otro producto con el mismo nombre.</h2>";
        }
    }

    if (isset($_POST['name3'])) {
        if (delete()) {
            echo "<h2>Producto eliminado con éxito</h2>";
        } else {
            echo "<h2>Producto no encontrado</h2>";
        }
    }

    if (isset($_POST['name4'])) {
        if (modify()) {
            echo "<h2>Producto modificado con éxito</h2>";
        } else {
            echo "<h2>Producto no encontrado</h2>";
        }
    }

    showList();
    ?>
</body>

</html>