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
    <label for='nombre'>Nombre:</label>
    <input type='text' name='nombre' value='" . $_POST['nombre'] . "'><br>

    <label for='descripcion'>Descripcion:</label>
    <input type='text' name='descripcion' value='" . $_POST['descripcion'] . "'><br>

    <label for='precio'>Precio:</label>
    <input type='text' name='precio' value='" . $_POST['precio'] . "'><br>

    <label for='descuento'>Descuento:</label>
    <input type='text' name='descuento' value='" . $_POST['descuento'] . "'><br>

    <input type='hidden' name='referencia' value='" . $_POST['referencia'] . "'>
    <input type='hidden' name='code' value='" . $_POST['code'] . "'>
    
    <input type='submit' name='nuevosDatos' value='ACEPTAR'>
</form>";
    } elseif (isset($_POST["cantidad"])) {
        echo "<h2>Edite la venta</h2>
<form method='post' action='index.php'>
    <label for='nombrepro'>Cantidad:</label>
    <input type='text' name='cantidad' value='" . $_POST['cantidad'] . "'><br>

    <label for='descripcion'>Fecha:</label>
    <input type='text' name='fecha' value='" . $_POST['fecha'] . "'><br>
    <input type='hidden' name='code' value='" . $_POST['code'] . "'>

    <input type='submit' name='nuevosDatos' value='ACEPTAR'>
</form>";
    }
}

function introducirDatos()
{

    if (isset($_POST["hijos"])) {

        $nuevoNombre = $_POST['nombre'];
        $nuevoSalario = $_POST['salario'];
        $nuevoHijos = $_POST['hijos'];
        $nuevofNacimiento = $_POST['fNacimiento'];

        $conexion = conectarDB();
        $codigo = 0;

        for ($i = 0; $i < 10000; $i++) {
            $sql = "SELECT codigo FROM comerciales WHERE codigo=$i";
            $result = $conexion->query($sql);

            $tamaño = $result->rowCount();

            if ($tamaño === 0) {
                $codigo = $i;
                break;
            }
        }

        $validacionComerciales = filtradorComerciales($nuevoNombre, $nuevoSalario, $nuevoHijos, $nuevofNacimiento);

        if ($validacionComerciales === true) {

            $sql = "INSERT INTO comerciales (codigo, nombre, salario, hijos, fNacimiento) VALUES (:code, :nombre, :salario, :hijos, :fNacimiento)";

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(":nombre", $nuevoNombre);
            $stmt->bindParam(":salario", $nuevoSalario);
            $stmt->bindParam(":hijos", $nuevoHijos);
            $stmt->bindParam(":fNacimiento", $nuevofNacimiento);
            $stmt->bindParam(":code", $codigo);

            if ($stmt->execute()) {
                echo "<br><p>Tu comercial se introdujo con éxito.</p>";
            } else {
                echo "<br><p>Hubo un error al insertar el comercial.</p>";
            }
        }

    } elseif (isset($_POST["precio"])) {

        $nuevoNombre = $_POST['nombre'];
        $nuevoDescripcion = $_POST['descripcion'];
        $nuevoPrecio = $_POST['precio'];
        $nuevofDescuento = $_POST['descuento'];

        $conexion = conectarDB();

        $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $referencia = '';

        $existRefe = true;

        while ($existRefe) {
            for ($i = 0; $i < 2; $i++) {
                $referencia .= $letras[rand(0, strlen($letras) - 1)];
            }

            $referencia .= str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

            $sql = "SELECT referencia FROM productos WHERE referencia='$referencia'";
            $result = $conexion->query($sql);

            $tamaño = $result->rowCount();

            if ($tamaño === 0) {
                $existRefe = false;
            }
        }

        $validacionProductos = filtradorProductos($nuevoNombre, $nuevoDescripcion, $nuevoPrecio, $nuevofDescuento);

        if ($validacionProductos === true) {

            $sql = "INSERT INTO productos (referencia, nombre, descripcion, precio, descuento) VALUES (:referencia, :nombre, :descripcion, :precio, :descuento)";

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(":nombre", $nuevoNombre);
            $stmt->bindParam(":descripcion", $nuevoDescripcion);
            $stmt->bindParam(":precio", $nuevoPrecio);
            $stmt->bindParam(":descuento", $nuevofDescuento);
            $stmt->bindParam(":referencia", $referencia);

            if ($stmt->execute()) {
                echo "<br><p>Tu producto se introdujo con éxito.</p>";
            } else {
                echo "<br><p>Hubo un error al insertar el producto.</p>";
            }
        }
    } elseif (isset($_POST["cantidad"])) {

        $nuevoPrecio = $_POST['cantidad'];
        $nuevoFecha = $_POST['fecha'];

        $conexion = conectarDB();
        $nombre = $_POST['nombreComercial'];
        $nom_refe = $_POST['nombreProducto'];
        $nom_refe_array = explode("-",$nom_refe);

        $nombreProducto = $nom_refe_array[0];
        $descripcionProducto = $nom_refe_array[1];

        $sql = "SELECT codigo FROM comerciales WHERE nombre = '$nombre'";
        $result = $conexion->query($sql);
        $codComercial = $result->fetch_assoc();

        $sql = "SELECT referencia FROM productos WHERE nombre = '$nombreProducto', descripcion='$descripcionProducto'";
        $result = $conexion->query($sql);
        $refProducto = $result->fetch_assoc();
        
        $validacionVentas = filtradorVentas($nuevoPrecio, $nuevoFecha);

        if ($validacionVentas === true) {

            $sql = "INSERT INTO ventas (codComercial, refProducto, cantidad, fecha) VALUES (:codComercial, :refProducto, :cantidad, :fecha)";

            $stmt = $conexion->prepare($sql);

            $stmt->bindParam(":cantidad", $nuevoNombre);
            $stmt->bindParam(":fecha", $nuevoDescripcion);
            $stmt->bindParam(":codComercial", $codComercial);
            $stmt->bindParam(":refProducto", $refProducto);

            if ($stmt->execute()) {
                echo "<br><p>Tu venta se introdujo con éxito.</p>";
            } else {
                echo "<br><p>Hubo un error al insertar la venta.</p>";
            }
        }
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

        $validacionComerciales = filtradorComerciales($nuevoNombre, $nuevoSalario, $nuevoHijos, $nuevofNacimiento);

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

        $nuevoNombre = $_POST['nombre'];
        $nuevoDescripcion = $_POST['descripcion'];
        $nuevoPrecio = $_POST['precio'];
        $nuevofDescuento = $_POST['descuento'];
        $referencia = $_POST['referencia'];

        $validacionProductos = filtradorProductos($nuevoNombre, $nuevoDescripcion, $nuevoPrecio, $nuevofDescuento);

        if ($validacionProductos === true) {
            $sql = "UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, descuento = :descuento WHERE referencia = :referencia";

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":nombre", $nuevoNombre);
            $stmt->bindParam(":descripcion", $nuevoDescripcion);
            $stmt->bindParam(":precio", $nuevoPrecio);
            $stmt->bindParam(":descuento", $nuevofDescuento);
            $stmt->bindParam(":referencia", $referencia);

            if ($stmt->execute()) {
                echo "<br><p>Los cambios se han guardado correctamente.</p>";
            } else {
                echo "Hubo un error al guardar los cambios.";
            }
        }

    } elseif (isset($_POST["cantidad"])) {

        $nuevoCantidad = $_POST['cantidad'];
        $nuevoFecha = $_POST['fecha'];

        $validacionProductos = filtradorVentas($nuevoCantidad, $nuevoFecha);

        if ($validacionProductos === true) {
            $sql = "UPDATE productos SET cantidad = :cantidad, fecha = :fecha WHERE referencia = :referencia";

            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":cantidad", $nuevoCantidad);
            $stmt->bindParam(":fecha", $nuevoFecha);

            if ($stmt->execute()) {
                echo "<br><p>Los cambios se han guardado correctamente.</p>";
            } else {
                echo "Hubo un error al guardar los cambios.";
            }
        }
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
        $contador = 0;
        $tablaGenerada = false;
        foreach ($arrayRefe as $value) {

            $sql = "SELECT * FROM productos WHERE referencia = '$value'";
            $result = $conexion->query($sql);
            $contador++;

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
                    echo "<input type='hidden' name='code' value='" . $code . "'>";
                    echo "<td>" . $row["referencia"] . "</td>";
                    echo "<input type='hidden' name='referencia' value='" . $row['referencia'] . "'>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<input type='hidden' name='nombre' value='" . $row['nombre'] . "'>";
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
                if ($contador === count($arrayRefe)) {
                    echo "</table>";
                }


            } else {
                echo "No se encontraron productos";
            }

        }

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
                    echo "<input type='hidden' name='code' value='" . $code . "'>";
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

function eleccionInsertar()
{
    echo " <form method='post' action='index.php'>
    <h2>Elije qué quieres introducir</h2>

    <label>
        <input type='radio' name='eleccion' value='Comercial'> Comercial
    </label>
    <br>

    <label>
        <input type='radio' name='eleccion' value='Producto'> Producto
    </label>
    <br>

    <label>
        <input type='radio' name='eleccion' value='Venta'> Venta
    </label>
    <br>
    <br>
    <input type='submit' name='submit' value='Aceptar'>
</form>";
}

function formulariosInsertar()
{

    if ($_POST['eleccion'] === "Comercial") {
        echo "<h2>AÑADE SU COMERCIAL</h2>
        <form method='post' action='index.php'>

        <label for='nombre'>Nombre:</label>
        <input type='text' name='nombre' id='nombre'>
        <br>
        <br>
        <label for='salario'>Salario:</label>
        <input type='text' name='salario' id='salario'>
        <br>
        <br>
        <label for='hijos'>Número de Hijos:</label>
        <input type='number' name='hijos' id='hijos'>
        <br>
        <br>
        <label for='fNacimiento'>Fecha de Nacimiento:</label>
        <input type='text' name='fNacimiento' id='fNacimiento'>
        <br>
        <br>
        <input type='submit' name='datosNuevos' value='AÑADIR'>
    </form>";
    } elseif ($_POST["eleccion"] === "Producto") {

        echo "<h2>AÑADE SU PRODUCTO</h2>
        <form method='post' action='index.php'>
        <label for='nombre'>Nombre:</label>
        <input type='text' name='nombre' id='nombre'>
        <br>
        <br>
        <label for='descripcion'>Descripcion:</label>
        <input type='text' name='descripcion' id='descripcion'>
        <br>
        <br>
        <label for='precio'>Precio:</label>
        <input type='text' name='precio' id='precio'>
        <br>
        <br>
        <label for='descuento'>Descuento:</label>
        <input type='text' name='descuento' id='descuento'>
        <br>
        <br>
        <input type='submit' name='datosNuevos' value='AÑADIR'>
        </form>";
    } elseif ($_POST["eleccion"] === "Venta") {
        echo "<h2>AÑADE LA VENTA DE UN PRODUCTO</h2>
        <form method='post' action='index.php'>
        <label for='nombreComercial'>Selecciona un comercial:</label>
        <select name='nombreComercial' id='nombreComercial'>";

        $conexion = conectarDB();
        $sql = "SELECT nombre FROM comerciales";
        $result = $conexion->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
        }

        $conexion = null;

        echo "</select>
        <br>
        <br>

        <label for='nombreProducto'>Selecciona un producto:</label>
        <select name='nombreProducto' id='nombreProducto'>";

        $conexion = conectarDB();
        $sql = "SELECT nombre,descripcion FROM productos";
        $result = $conexion->query($sql);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . $row['nombre'] . "-" . $row['descripcion'] . "'>" . $row['nombre'] . "-" . $row['descripcion'] . "</option>";
        }

        $conexion = null;

        echo "</select>
        <br>
        <br>
        <label for='cantidad'>Cantidad:</label>
        <input type='text' name='cantidad' id='cantidad'>
        <br>
        <br>
        <label for='fecha'>Fecha:</label>
        <input type='date' name='fecha' id='fecha'>
        <br>
        <br>
        <input type='submit' name='datosNuevos' value='AÑADIR'>
        </form>";
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
        echo "<br>Error en el nombre, se introdujeron otros carácteres diferentes a letras.";
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

    $conexion = conectarDB();
    $sql = "SELECT nombre FROM comerciales";
    $result = $conexion->query($sql);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        if ($row['nombre'] === $nombre) {
            $valido = false;
            echo "<br>Error en el nombre, ya se encuentra otro comercial con el mismo nombre.";
        }
    }

    return $valido;
}

function filtradorProductos($nombre, $descripcion, $precio, $descuentos)
{

    $valido = true;

    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóú\s]+$/', $nombre)) {
        $valido = false;
        echo "<br>Error en el nombre, se introdujeron otros carácteres diferentes a letras.";
    }
    if (!preg_match('/^[A-Za-zÁÉÍÓÚáéíóú\s]+$/', $descripcion)) {
        $valido = false;
        echo "<br>Erro en el nombre, se introdujeron otros carácteres diferentes a letras.";
    }
    if (!is_numeric($precio) || $precio < 0) {
        $valido = false;
        echo "<br>Ese número de hijos no es válido.";
    }
    if (!is_numeric($descuentos) || $descuentos < 0) {
        $valido = false;
        echo "<br>Ese número de salario no es válido.";
    }

    return $valido;
}

function filtradorVentas($cantidad, $fecha)
{

    $valido = true;

    if (!is_numeric($cantidad) || $cantidad < 0) {
        $valido = false;
        echo "<br>Ese número de hijos no es válido.";
    }
    if (!validarFecha($fecha)) {
        $valido = false;
        echo "<br>Formato de fecha no válido. Utiliza YYYY-MM-DD.";
    }

    return $valido;
}
