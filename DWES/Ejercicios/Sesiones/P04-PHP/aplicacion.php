<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
session_start();

if (isset($_COOKIE['colorFondo'])){
    $color = $_COOKIE['colorFondo'];
}
?>
<body>
    <h1>Bienvenido <?php echo $_SESSION['usuario']?></h1>
    <h2>Inicio sesión : <?php echo $_SESSION['hora']?></h2>
    <form action="aplicacion.php" method="post">
        <button type="submit" name="informacion">Información</button>
        <button type="submit" name="preferencia">Preferencia</button>
        <button type="submit" name="cerrar_sesion">Cerrar sesión</button>
    </form>
    <style>
        body { background-color: <?php echo $color ?>; }
    </style>

    <?php
    
    
//VARIOUS OPTIONS WHEN USING EACH MENU BUTTON
//IN THE FIRST ONE WE ELIMINATE THE SESSIONS
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