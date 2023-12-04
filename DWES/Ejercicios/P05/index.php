<!DOCTYPE html>
<html lang="es">
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

    //WE CHECK IF THERE IS A SESSION STARTED
    if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
        header("Location: aplicacion.php");
        exit();
    }

    //IF WE LOG IN WE CHECK IF THE USER AND PASSWORD ARE CORRECT
    if (isset($_POST['inicio_sesion'])) {

        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];
        $horaInicio = date('H:i:s');

        //FUNCTION THAT OBTAINS THE HASH FROM THE DATABASE ACCORDING TO THE USER
        $hashAlmacenado = obtenerHashBaseDeDatos($usuario);

        //WE VERIFY THE PASSWORD ENTERED WITH THE HASH
        if ($hashAlmacenado && password_verify($contrasena, $hashAlmacenado)) {

            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['hora'] = $horaInicio;
            header("Location: aplicacion.php");
            exit();

        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }
?>
</body>
</html>