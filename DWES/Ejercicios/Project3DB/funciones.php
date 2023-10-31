<?php
function conectarDB()
{
    $dsn = "mysql:host=localhost;dbname=ventas_comerciales";
    $usuario = "root";
    $contrasena = "";

    try {
        $conexion = new PDO($dsn, $usuario, $contrasena);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo ("Conexión exitosa a la base de datos.");
    } catch (PDOException $e) {
        echo("Error de conexión: " . $e->getMessage());
    }
}

function verFormuConsulta(){
    
}
?>