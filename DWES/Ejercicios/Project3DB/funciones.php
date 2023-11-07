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

function FormuModifica()
{
    if (isset($_POST["salario"])) {
        echo "<h2>Edite su comercial</h2>
<form method='post' action='index.php'>
    <label for='nombre'>Nombre:</label>
    <input type='text' name='nombre' value='" . $_POST['nombre'] . "'><br>

    <label for='salario'>Salario:</label>
    <input type='text' name='salario' value='" . $_POST['salario'] . "'><br>

    <label for='hijos'>Hijos:</label>
    <input type='text' name='hijos' value='" . $_POST['hijos'] . "'><br>

    <label for='fNacimiento'>Fecha de Nacimiento:</label>
    <input type='text' name='fNacimiento' value='" . $_POST['fNacimiento'] . "'><br>
    
    <input type='hidden' name='code' value='" . $_POST['code'] . "'>

    <input type='submit' name='nuevosDatos' value='ACEPTAR'>
</form>";
    } elseif (isset($_POST["descripcion"])) {
        echo "<h2>Edite su producto</h2>
<form method='post' action='index.php'>
    <label for='nombrepro'>Nombre:</label>
    <input type='text' name='nombrepro' placeholder='" . $_POST['nombrepro'] . " '><br>

    <label for='descripcion'>Descripcion:</label>
    <input type='text' name='descripcion' placeholder='" . $_POST['descripcion'] . "'><br>

    <label for='precio'>Precio:</label>
    <input type='text' name='precio' placeholder='" . $_POST['precio'] . "'><br>

    <label for='descuento'>Descuento:</label>
    <input type='text' name='descuento' placeholder='" . $_POST['descuento'] . "'><br>

    <input type='submit' name='nuevosDatos' value='ACEPTAR'>
</form>";
    } elseif (isset($_POST["cantidad"])) {
        echo "<h2>Edite la venta</h2>
<form method='post' action='index.php'>
    <label for='nombrepro'>Cantidad:</label>
    <input type='text' name='cantidad' placeholder='" . $_POST['cantidad'] . "'><br>

    <label for='descripcion'>Fecha:</label>
    <input type='text' name='fecha' placeholder='" . $_POST['fecha'] . "'><br>

    <input type='submit' name='nuevosDatos' value='ACEPTAR'>
</form>";
    }
}

function buscaModi()
{
    echo "<h2>Elija el código de los datos que quiere modificar</h2>
            <form method='post' action='index.php'>
                Código del comercial: <input type='text' name='code2' required><br>
                <input type='submit' value='Buscar'>
            </form>";
}

function editaDatos()
{
    $conexion = conectarDB();

    if (isset($_POST["salario"])) {

        $nuevoNombre = $_POST['nombre'];
        $nuevoSalario = $_POST['salario'];
        $nuevoHijos = $_POST['hijos'];
        $nuevofNacimiento = $_POST['fNacimiento'];
        $code = $_POST['code'];

        $validacionComerciales = filtradorComerciales($nuevoNombre,$nuevoSalario,$nuevoHijos,$nuevofNacimiento);

        if ($validacionComerciales === true) {
            $sql = "UPDATE comerciales SET nombre = :nombre, salario = :salario, hijos = :hijos, fNacimiento = :fNacimiento WHERE codigo = :code";

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":nombre", $nuevoNombre);
            $stmt->bindParam(":salario", $nuevoSalario);
            $stmt->bindParam(":hijos", $nuevoHijos);
            $stmt->bindParam(":fNacimiento", $nuevofNacimiento);
            $stmt->bindParam(":code", $code);

            if ($stmt->execute()) {
                echo "<br><p>Los cambios se han guardado correctamente.</p>";
            } else {
                echo "Hubo un error al guardar los cambios.";
            }
        }


    } elseif (isset($_POST["descripcion"])) {

    } elseif (isset($_POST["cantidad"])) {

    }
}
function consultarDatos()
{
    $code = (int) ($_POST["code"]);
    $conexion = conectarDB();

    //PRIMERA TABLA - COMERCIALES
    {
        $sql = "SELECT * FROM comerciales WHERE codigo = $code";
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
            echo "No se encontraron comerciales";
        }
    }
    echo "<br>";
    //SEGUNDA TABLA - PRODUCTOS
    {
        $ref = ($conexion->query("SELECT refProducto FROM ventas WHERE codComercial = $code"));
        $arrayRefe = array();

        // Recorre los resultados y agrega los valores únicos al array
        while ($row = $ref->fetch(PDO::FETCH_ASSOC)) {
            $refProducto = $row['refProducto'];
            if (!in_array($refProducto, $arrayRefe)) {
                $arrayRefe[] = $refProducto;
            }
        }

        $tablaGenerada = false;
        foreach ($arrayRefe as $value) {

            $sql = "SELECT * FROM productos WHERE referencia = '$value'";
            $result = $conexion->query($sql);

            if ($result->rowCount() > 0) {

                if (!$tablaGenerada) {
                    echo "<table border='1'><caption>PRODUCTOS</caption>
                <tr>
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                </tr>";

                    $tablaGenerada = true;
                }

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["referencia"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>" . $row["precio"] . "€</td>";
                    echo "<td>" . $row["descuento"] . "%</td>";
                    echo "</tr>";
                }

            } else {
                echo "No se encontraron productos";
            }
        }
        echo "</table>";
    } {
        echo "<br>";
        //TERCERA TABLA - VENTAS
        {
            $sql = "SELECT * FROM ventas WHERE codComercial = $code";
            $result = $conexion->query($sql);

            if ($result->rowCount() > 0) {
                echo "<table border='1'><caption>VENTAS</caption>
                    <tr>
                        <th>Referencia</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                    </tr>";

                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["refProducto"] . "</td>";
                    echo "<td>" . $row["cantidad"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron ventas";
            }
        }
        $conexion = null;
    }
}

function verModificarDatos()
{
    $code = (int) ($_POST["code2"]);
    $conexion = conectarDB();

    //PRIMERA TABLA - COMERCIALES
    {
        $sql = "SELECT * FROM comerciales WHERE codigo = $code";
        $result = $conexion->query($sql);

        if ($result->rowCount() > 0) {
            echo "<table border='1'><caption>COMERCIALES</caption>
                <tr>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Hijos</th>
                    <th>F.Nacimiento</th>
                </tr>";

            echo "<form method='post' action='index.php'>";

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<input type='hidden' name='code' value='" . $code . "'>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<input type='hidden' name='nombre' value='" . $row['nombre'] . "'>";
                echo "<td>" . $row["salario"] . "</td>";
                echo "<input type='hidden' name='salario' value='" . $row['salario'] . "'>";
                echo "<td>" . $row["hijos"] . "</td>";
                echo "<input type='hidden' name='hijos' value='" . $row['hijos'] . "'>";
                echo "<td>" . $row["fNacimiento"] . "</td>";
                echo "<input type='hidden' name='fNacimiento' value='" . $row['fNacimiento'] . "'>";
                echo "<td><input type='submit' name='datostabla' value='EDITAR'></td>";
                echo "</tr>";
            }
            echo "</form>";

            echo "</table>";
        } else {
            echo "No se encontraron comerciales";
        }
    }
    echo "<br>";
    //SEGUNDA TABLA - PRODUCTOS
    {
        $ref = ($conexion->query("SELECT refProducto FROM ventas WHERE codComercial = $code"));
        $arrayRefe = array();

        // Recorre los resultados y agrega los valores únicos al array
        while ($row = $ref->fetch(PDO::FETCH_ASSOC)) {
            $refProducto = $row['refProducto'];
            if (!in_array($refProducto, $arrayRefe)) {
                $arrayRefe[] = $refProducto;
            }
        }

        $tablaGenerada = false;
        foreach ($arrayRefe as $value) {

            $sql = "SELECT * FROM productos WHERE referencia = '$value'";
            $result = $conexion->query($sql);

            if ($result->rowCount() > 0) {


                if (!$tablaGenerada) {
                    echo "<table border='1'><caption>PRODUCTOS</caption>
                <tr>
                    <th>Referencia</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                </tr>";

                    $tablaGenerada = true;
                }
                echo "<form method='post' action='index.php'>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["referencia"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<input type='hidden' name='nombrepro' value='" . $row['nombre'] . "'>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<input type='hidden' name='descripcion' value='" . $row['descripcion'] . "'>";
                    echo "<td>" . $row["precio"] . "€</td>";
                    echo "<input type='hidden' name='precio' value='" . $row['precio'] . "'>";
                    echo "<td>" . $row["descuento"] . "%</td>";
                    echo "<input type='hidden' name='descuento' value='" . $row['descuento'] . "'>";
                    echo "<td><input type='submit' name='datostabla' value='EDITAR'></td>";
                    echo "</tr>";
                }
                echo "</form>";

            } else {
                echo "No se encontraron productos";
            }

        }
        echo "</table>";
    } {
        echo "<br>";
        //TERCERA TABLA - VENTAS
        {
            $sql = "SELECT * FROM ventas WHERE codComercial = $code";
            $result = $conexion->query($sql);

            if ($result->rowCount() > 0) {
                echo "<table border='1'><caption>VENTAS</caption>
                    <tr>
                        <th>Referencia</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                    </tr>";
                echo "<form method='post' action='index.php'>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["refProducto"] . "</td>";
                    echo "<td>" . $row["cantidad"] . "</td>";
                    echo "<input type='hidden' name='cantidad' value='" . $row['cantidad'] . "'>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<input type='hidden' name='fecha' value='" . $row['fecha'] . "'>";
                    echo "<td><input type='submit' name='datostabla' value='EDITAR'></td>";
                    echo "</tr>";
                }
                echo "</form>";
                echo "</table>";
            } else {
                echo "No se encontraron ventas";
            }
        }
        $conexion = null;
    }
}

function validarFecha($fecha)
{
    // Expresión regular para el formato YYYY-MM-DD
    $patron = "/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/";
    return preg_match($patron, $fecha);
}

function comprobadorPorciento($porciento)
{

    if ($porciento > 100 | $porciento < 0) {
        echo "El porcentaje introducido no es válido";
    } else {
        return $porciento;
    }
}

function filtradorComerciales($nombre, $salario, $hijos, $fNacimiento)
{

    $valido = true;

    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóú\s]+$/', $nombre)) {
        $valido = false;
        echo "<br>Erro en el nombre, se introdujeron otros carácteres diferentes a letras.";
    }
    if (!validarFecha($fNacimiento)) {
        $valido = false;
        echo "<br>Formato de fecha no válido. Utiliza YYYY-MM-DD.";
    }
    if (!is_numeric($hijos) || $hijos < 0) {
        $valido = false;
        echo "<br>Ese número de hijos no es válido.";
    }
    if (!is_numeric($salario) || $salario < 0) {
        $valido = false;
        echo "<br>Ese número de salario no es válido.";
    }

    return $valido;
}
