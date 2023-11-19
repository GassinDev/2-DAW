<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>HOLA USUARIO</h1>
    <form action="index.php" method="post">
        <input type="hidden" name="cerrar_sesion" value="1">
        <button type="submit" >Cerrar sesión</button>
    </form>

    <?php
    session_start();

    if (isset($_POST["cerrar_sesion"])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
    ?>
</body>

</html>