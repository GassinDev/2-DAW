<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='styles.css'>
</head>

<body>
    <h1>Bienvenido Administrador</h1>
    <form id="menuNav" method="post" action="index.php">
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
            eleccionInsertar("eleinsert");
            echo "<br>";
        } elseif ($action === 'MODIFICACION') {
            buscaModi();
            echo "<br>";
        } elseif ($action === "ELIMINACION") {
            eleccionInsertar("eleinsert2");
            echo "<br>";
        }
    }

    if(isset($_POST["code"])) {
        consultarDatos();
    }elseif(isset($_POST["code2"])) {
        verModificarDatos();
    }elseif(isset($_POST["Mostrartodo"])) {
        consultarTodo();
    }

    if(isset($_POST["datostabla"])) {
        FormuModifica();
    }

    if(isset($_POST["nuevosDatos"])) {
        editaDatos();
    }

    if(isset($_POST["eleinsert"])) {
        formulariosInsertar();
    }

    if(isset($_POST["eleinsert2"])) {
        mostrarDatosBorrar();
    }

    if(isset($_POST["datosNuevos"])) {
        introducirDatos();
    }

    if(isset($_POST["datostablaBoCo"]) || isset($_POST["datostablaBoPro"]) || isset($_POST["datostablaBoVe"])) {
        borrarDatos();
    }
    ?>
</body>


</html>