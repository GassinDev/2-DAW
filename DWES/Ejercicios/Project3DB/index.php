<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido Administrador</h1>
    <h2>FUNCIONES QUE PUEDE REALIZAR</h2>
    <form method="post" action="index.php">
        <input type="submit" name="action" value="CONSULTA">
        <input type="submit" name="action" value="INSERCION">
        <input type="submit" name="action" value="MODIFICACION">
        <input type="submit" name="action" value="ELIMINACION">
    </form><br>

    <?php
    include("funciones.php");
    conectarDB();
    if (isset($_POST['action'])) {

        $action = $_POST['action'];

        if ($action === 'CONSULTA') {
            verFormuConsulta();
            echo "<br>";
        } elseif ($action === 'INSERCION') {
            
            echo "<br>";
        } elseif ($action === 'MODIFICACION') {
            verFormuModi();
            echo "<br>";
        } elseif ($action === "ELIMINACION") {

        }
    }

    if(isset($_POST["code"])) {
        consultarDatos();
    }elseif(isset($_POST["code2"])) {
        mostrarModificaDatos();
    }

    if(isset($_POST["hijos"])) {
        modificarDatos();
    }
    ?>
</body>


</html>