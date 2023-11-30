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

    //We see that you have used one of the buttons and if so we classify it according to the value
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

    // Check if the "name" field is set in the POST data
    if (isset($_POST["name"])) {
        // If set, attempt to insert the product
        if (insert()) {
            echo "<h2>Producto añadido con éxito</h2>";
        } else {
            echo "<h2>Producto no añadido- ERROR: Ya se encontró otro producto con el mismo nombre.</h2>";
        }
    }

    // Check if the "name3" field is set in the POST data
    if (isset($_POST['name3'])) {
        // If set, attempt to delete the product
        if (delete()) {
            echo "<h2>Producto eliminado con éxito</h2>";
        } else {
            echo "<h2>Producto no encontrado</h2>";
        }
    }

    // Check if the "name4" field is set in the POST data
    if (isset($_POST['name4'])) {
        // If set, attempt to modify the product
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