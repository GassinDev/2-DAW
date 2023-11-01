<?php
function conectarDB()
{
    $dsn = "mysql:host=localhost;dbname=ventas_comerciales";
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

function verFormuConsulta()
{
    echo "<h2>Consulte sus datos</h2>
            <form method='post' action='index.php'>
                Código del comercial: <input type='text' name='code' required><br>
                <input type='submit' value='Buscar'>
            </form>";
}

function verFormuModi()
{
    echo "<h2>Elija el código de los datos que quiere modificar</h2>
            <form method='post' action='index.php'>
                Código del comercial: <input type='text' name='code2' required><br>
                <input type='submit' value='Buscar'>
            </form>";
}

function consultarDatos()
{
    $code = (int)($_POST["code"]);
    $conexion = conectarDB();

    //PRIMERA TABLA - COMERCIALES
    {$sql = "SELECT * FROM comerciales WHERE codigo = $code";
    $result = $conexion->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table border='1'><caption>COMERCIALES</caption>
                <tr>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Hijos</th>
                    <th>F.Nacimiento</th>
                </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["salario"] . "</td>";
            echo "<td>" . $row["hijos"] . "</td>";
            echo "<td>" . $row["fNacimiento"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros";
    }
    }
    echo "<br>";
    //SEGUNDA TABLA - PRODUCTOS
    {   $ref = ($conexion->query("SELECT refProducto FROM ventas WHERE codComercial = $code"));
        $referencia = $ref->fetchColumn();

        $sql = "SELECT * FROM productos WHERE referencia = '$referencia'";
        $result = $conexion->query($sql);
    
        if ($result->rowCount() > 0) {
            echo "<table border='1'><caption>PRODUCTOS</caption>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                    </tr>";
    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";
                echo "<td>" . $row["precio"] . "€</td>";
                echo "<td>" . $row["descuento"] . "%</td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "No se encontraron registros";
        }
    }
        echo "<br>";
    //TERCERA TABLA - VENTAS
    {$sql = "SELECT * FROM ventas WHERE codComercial = $code";
        $result = $conexion->query($sql);
    
        if ($result->rowCount() > 0) {
            echo "<table border='1'><caption>VENTAS</caption>
                    <tr>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                    </tr>";
    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "No se encontraron registros";
        }
    }
    $conexion = null;
}

function mostrarModificaDatos()
{
    $code = (int)($_POST["code2"]);
    $conexion = conectarDB();

    //PRIMERA TABLA - COMERCIALES
    {$sql = "SELECT * FROM comerciales WHERE codigo = $code";
    $result = $conexion->query($sql);

    if ($result->rowCount() > 0) {
        echo "<form method='post' action='index.php'>
        <table border='1'><caption>COMERCIALES</caption>
                <tr>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Hijos</th>
                    <th>F.Nacimiento</th>
                </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td> <input type='text' name='nombre' placeholder='" .$row["nombre"]. "'> </td>";
            echo "<td> <input type='text' name='salario' placeholder='" .$row["salario"]. "'> </td>";
            echo "<td> <input type='text' name='hijos' placeholder='" .$row["hijos"]. "'> </td>";
            echo "<td> <input type='text' name='fNacimiento' placeholder='" .$row["fNacimiento"]. "'> </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros";
    }
    }
    echo "<br>";
    //SEGUNDA TABLA - PRODUCTOS
    {   $ref = ($conexion->query("SELECT refProducto FROM ventas WHERE codComercial = $code"));
        $referencia = $ref->fetchColumn();

        $sql = "SELECT * FROM productos WHERE referencia = '$referencia'";
        $result = $conexion->query($sql);
    
        if ($result->rowCount() > 0) {
            echo "<table border='1'><caption>PRODUCTOS</caption>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Descuento</th>
                    </tr>";
    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td> <input type='text' name='nombrepro' placeholder='" .$row["nombre"]. "'> </td>";
                echo "<td> <input type='text' name='descripcion' placeholder='" . $row["descripcion"] . "'> </td>";
                echo "<td> <input type='text' name='precio' placeholder='" . $row["precio"] . "'> </td>";
                echo "<td> <input type='text' name='descuento' placeholder='" . $row["descuento"] . "'> </td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "No se encontraron registros";
        }
    }
        echo "<br>";
    //TERCERA TABLA - VENTAS
    {$sql = "SELECT * FROM ventas WHERE codComercial = $code";
        $result = $conexion->query($sql);
    
        if ($result->rowCount() > 0) {
            echo "<table border='1'><caption>VENTAS</caption>
                    <tr>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                    </tr>";
    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td> <input type='text' name='descuento' placeholder='" . $row["cantidad"] . "'> </td>";
                echo "<td> <input type='text' name='descuento' placeholder='" . $row["fecha"] . "'> </td>";
                echo "</tr>";
            }
    
            echo "</table><br><input type='submit' value='Asignar'></form>";
        } else {
            echo "No se encontraron registros";
        }
    }
    $conexion = null;
}

function modificarDatos(){
    
}
