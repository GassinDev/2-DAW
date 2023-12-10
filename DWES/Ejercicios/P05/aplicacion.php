<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();
require("funciones.php");

echo 'Inicio en la Aplicación con éxito - Desarrollada por Juan José Flores Gassín';
?>
<body>
    <h1>Bienvenido <?php echo $_SESSION['usuario']?></h1>
    <h2>Inicio sesión : <?php echo $_SESSION['hora']?></h2>
    <form action="aplicacion.php" method="post">
        <button type="submit" name="formDarAlta">Dar de Alta un nuevo usuario</button>
        <button type="submit" name="modificar">Modificar usuario</button>
        <button type="submit" name="eliminar">Eliminar usuario</button>
        <button type="submit" name="cerrar_sesion">Cerrar sesión</button>
    </form>
    
    <?php
    verDatos();
    //VARIAS OPCIONES AL USAR CADA BOTON DEL MENÚ
    if (isset($_POST["cerrar_sesion"])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if(isset($_POST["formDarAlta"])){
        echo "<br>";
        formAlta();
    }

    if(isset($_POST["modificar"])){
        echo "<br>";
        formBuscaModificar();
    }

    if(isset($_POST["BuscarModi"])){
        if(buscaDatosUsuario()){
            $usuario = buscaDatosUsuario();
            formModificar($usuario);
        }else{
            echo "<br>";
            echo "Usuario no encontrado.";
        }
    }

    if(isset($_POST["modificarDatos"])){
        echo "<br>";
        modificarUsuario();
    }

    if(isset($_POST["eliminar"])){
        echo "<br>";
        formEliminar();
    }

    if(isset($_POST['darAlta'])){
        darAlta();
    }

    if(isset($_POST['eliminarUsuario'])){
        eliminarUsuario();
    }
    ?>
</body>

</html>