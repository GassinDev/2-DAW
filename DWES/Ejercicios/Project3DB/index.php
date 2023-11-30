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
    <!-- Navigation form to select actions -->
    <form id="menuNav" method="post" action="index.php">
        <input type="submit" name="action" value="CONSULTA">
        <input type="submit" name="action" value="INSERCION">
        <input type="submit" name="action" value="MODIFICACION">
        <input type="submit" name="action" value="ELIMINACION">
    </form><br>

    <?php
    // Include the functions file and connect to the database
    include("funciones.php");
    conectarDB();

    // Check if an action has been selected
    if (isset($_POST['action'])) {

        $action = $_POST['action'];

        // Perform actions based on the selected option
        if ($action === 'CONSULTA') {
            verFormuConsulta(); // Function to display the query form
            echo "<br>";
        } elseif ($action === 'INSERCION') {
            eleccionInsertar("eleinsert"); // Function to display the insertion form
            echo "<br>";
        } elseif ($action === 'MODIFICACION') {
            buscaModi(); // Function to search for data to modify
            echo "<br>";
        } elseif ($action === "ELIMINACION") {
            eleccionInsertar("eleinsert2"); // Function to display the deletion form
            echo "<br>";
        }
    }

    // Perform actions based on the selected options after the main form
    if(isset($_POST["code"])) {
        consultarDatos(); // Function to query specific data
    } elseif(isset($_POST["code2"])) {
        verModificarDatos(); // Function to display data to modify
    } elseif(isset($_POST["Mostrartodo"])) {
        consultarTodo(); // Function to query all data
    }

    if(isset($_POST["datostabla"])) {
        FormuModifica(); // Function to display modification form
    }

    if(isset($_POST["nuevosDatos"])) {
        editaDatos(); // Function to edit data
    }

    if(isset($_POST["eleinsert"])) {
        formulariosInsertar(); // Function to display insertion forms
    }

    if(isset($_POST["eleinsert2"])) {
        mostrarDatosBorrar(); // Function to display data to delete
    }

    if(isset($_POST["datosNuevos"])) {
        introducirDatos(); // Function to enter new data
    }

    // Perform actions based on the selected options to delete data
    if(isset($_POST["datostablaBoCo"]) || isset($_POST["datostablaBoPro"]) || isset($_POST["datostablaBoVe"])) {
        borrarDatos(); // Function to delete data from different tables
    }
    ?>
</body>

</html>