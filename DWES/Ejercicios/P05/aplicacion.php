<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();


echo '<script language="javascript">alert("Entrando en la Aplicación - Desarrollada por Juan José Flores Gassín");</script>';
?>
<body>
    <h1>Bienvenido <?php echo $_SESSION['usuario']?></h1>
    <h2>Inicio sesión : <?php echo $_SESSION['hora']?></h2>
    <form action="aplicacion.php" method="post">
        <button type="submit" name="darAlta">Dar de Alta un nuevo usuario</button>
        <button type="submit" name="informacion">Modificar usuario</button>
        <button type="submit" name="preferencia">Eliminar usuario</button>
        <button type="submit" name="cerrar_sesion">Cerrar sesión</button>
    </form>
    
    <?php
    
    //VARIAS OPCIONES AL USAR CADA BOTON DEL MENÚ
    if (isset($_POST["cerrar_sesion"])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }elseif(isset($_POST["preferencia"])){
        header("Location: preferencia.php");
    }elseif(isset($_POST["informacion"])){
        header("Location: información.php");
    }

    ?>
</body>

</html>