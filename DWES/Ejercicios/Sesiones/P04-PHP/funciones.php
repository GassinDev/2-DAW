<?php

//TO CONNECT TO THE DATABASE
function conectarDB()
{
    $dsn = "mysql:host=localhost;dbname=tarea4";
    $usuario = "root";
    $contrasena = "";

    try {
        $conexion = new PDO($dsn, $usuario, $contrasena);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        echo ("Error de conexión: " . $e->getMessage());
    }
}

//FUNCTION TO OBTAIN THE DATABASE HASH
function obtenerHashBaseDeDatos($usuario)
{
    try {

        $conexion = conectarDB();

        $sql = "SELECT pwd FROM usuarios WHERE usuario = :usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $conexion = null;

        return $result ? $result['pwd'] : false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    return false;
}


//TO DELETE THE COOKIE
function borrarCookie($nombreCookie){
    setcookie('colorFondo', '', time() - 3600, "/");
}
?>