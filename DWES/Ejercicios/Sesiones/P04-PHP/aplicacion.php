<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>HOLA USUARIO</h1>
    <form action="aplicacion.php" method="post">
        <button type="submit" name="informacion">Información</button>
        <button type="submit" name="preferencia">Preferencia</button>
        <button type="submit" name="cerrar_sesion">Cerrar sesión</button>
    </form>

    <?php
    session_start();

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

    if ($_COOKIE['colorFondo']) {
        $color = $_COOKIE['colorFondo'];
        echo "<style>body { background-color: $color; }</style>";
    }
    
    ?>
</body>

</html>