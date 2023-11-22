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

    //COMPROBAMOS SI HAY UNA SESION INICIADA
    if (isset($_SESSION['usuario_autenticado']) && $_SESSION['usuario_autenticado'] === true) {
        header("Location: aplicacion.php");
        exit();
    }

    //SI INICIAMOS SESION COMPROBAMOS SI ES CORRECTO EL USUARIO Y LA CONTRASEÑA
    if (isset($_POST['inicio_sesion'])) {

        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];
        $horaInicio = date('H:i:s');

        //FUNCION QUE OBTIENE EL HASH DE LA BASE DE DATOS SEGUN EL USUARIO
        $hashAlmacenado = obtenerHashBaseDeDatos($usuario);

        //VERIFICAMOS LA CONTRASEÑA INTRODUCIDA CON EL HASH
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

    //PARA VER LA INFORMACION SIN INICIAR SESION
    if (isset($_POST['continuar_como_invitado'])) {
        header("Location: información.php");
            exit();
    }

    ?>
    
    <form action="index.php" method="post">
        <input type="hidden" name="continuar_como_invitado" value="1">
        <button type="submit" >Continuar como invitado</button>
    </form>
    
</body>

</html>