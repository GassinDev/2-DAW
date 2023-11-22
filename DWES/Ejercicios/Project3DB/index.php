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
    <!-- Formulario de navegación para seleccionar acciones -->
    <form id="menuNav" method="post" action="index.php">
        <input type="submit" name="action" value="CONSULTA">
        <input type="submit" name="action" value="INSERCION">
        <input type="submit" name="action" value="MODIFICACION">
        <input type="submit" name="action" value="ELIMINACION">
    </form><br>

    <?php
    // Incluir el archivo de funciones y conectar a la base de datos
    include("funciones.php");
    conectarDB();

    // Verificar si se ha seleccionado una acción
    if (isset($_POST['action'])) {

        $action = $_POST['action'];

        // Realizar acciones según la opción seleccionada
        if ($action === 'CONSULTA') {
            verFormuConsulta(); // Función para mostrar formulario de consulta
            echo "<br>";
        } elseif ($action === 'INSERCION') {
            eleccionInsertar("eleinsert"); // Función para mostrar formulario de inserción
            echo "<br>";
        } elseif ($action === 'MODIFICACION') {
            buscaModi(); // Función para buscar datos a modificar
            echo "<br>";
        } elseif ($action === "ELIMINACION") {
            eleccionInsertar("eleinsert2"); // Función para mostrar formulario de eliminación
            echo "<br>";
        }
    }

    // Realizar acciones según las opciones seleccionadas después del formulario principal
    if(isset($_POST["code"])) {
        consultarDatos(); // Función para consultar datos específicos
    } elseif(isset($_POST["code2"])) {
        verModificarDatos(); // Función para mostrar datos a modificar
    } elseif(isset($_POST["Mostrartodo"])) {
        consultarTodo(); // Función para consultar todos los datos
    }

    if(isset($_POST["datostabla"])) {
        FormuModifica(); // Función para mostrar formulario de modificación
    }

    if(isset($_POST["nuevosDatos"])) {
        editaDatos(); // Función para editar datos
    }

    if(isset($_POST["eleinsert"])) {
        formulariosInsertar(); // Función para mostrar formularios de inserción
    }

    if(isset($_POST["eleinsert2"])) {
        mostrarDatosBorrar(); // Función para mostrar datos a borrar
    }

    if(isset($_POST["datosNuevos"])) {
        introducirDatos(); // Función para introducir nuevos datos
    }

    // Realizar acciones según las opciones seleccionadas para borrar datos
    if(isset($_POST["datostablaBoCo"]) || isset($_POST["datostablaBoPro"]) || isset($_POST["datostablaBoVe"])) {
        borrarDatos(); // Función para borrar datos de distintas tablas
    }
    ?>
</body>

</html>