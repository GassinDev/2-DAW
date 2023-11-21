<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <button type="submit" name="inicio_sesion">Iniciar Sesión</button>
    </form>

    <?php
    session_start();
    include("funciones.php");

    if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
        header("Location: aplicacion.php");
        exit();
    }

    if (isset($_POST['inicio_sesion'])) {

        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];

        $hashAlmacenado = obtenerHashBaseDeDatos($usuario);

        if ($hashAlmacenado && password_verify($contrasena, $hashAlmacenado)) {

            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['usuario'] = $usuario;
            header("Location: aplicacion.php");
            exit();

        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }

    if (isset($_POST['continuar_como_invitado'])) {
        header("Location: información.php");
            exit();
    }

    if(isset($_COOKIE['fondoColor'])){
        echo $_COOKIE['fondoColor'];
    }
    ?>
    
    <form action="index.php" method="post">
        <input type="hidden" name="continuar_como_invitado" value="1">
        <button type="submit" >Continuar como invitado</button>
    </form>
    
</body>

</html>