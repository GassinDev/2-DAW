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
            echo "No se encontraron registros";
        }
    }
    echo "<br>";
    //SEGUNDA TABLA - PRODUCTOS
    {
        $ref = ($conexion->query("SELECT refProducto FROM ventas WHERE codComercial = $code"));
        $arrayRefe = array();

        // Recorre los resultados y agrega los valores únicos al array
        while ($row = $ref->fetch(PDO::FETCH_ASSOC)){
            $refProducto = $row['refProduct'];
            if (!in_array($refProducto, $arrayRefe)) {
                $arrayRefe[] = $refProducto;
            }
        }
        
        foreach ($arrayRefe as $value){
        
        // $referencia = $ref->fetchColumn();
        // $refeacortada = substr($referencia,0,2);
        // $sql = "SELECT * FROM productos WHERE referencia LIKE '$refeacortada%'";
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
    {
        $sql = "SELECT * FROM ventas WHERE codComercial = $code";
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
    $code = (int) ($_POST["code2"]);
    $conexion = conectarDB();

    //PRIMERA TABLA - COMERCIALES
    
        $sql = "SELECT * FROM comerciales WHERE codigo = $code";
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
                echo "<td> <input type='text' name='nombre' placeholder='" . $row["nombre"] . "'> </td>";
                echo "<td> <input type='text' name='salario' placeholder='" . $row["salario"] . "'> </td>";
                echo "<td> <input type='text' name='hijos' placeholder='" . $row["hijos"] . "'> </td>";
                echo "<td> <input type='date' name='fNacimiento' placeholder='" . $row["fNacimiento"] . "'> </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron registros";
        }
    
    echo "<br>";
    // SEGUNDA TABLA - PRODUCTOS
    $ref = ($conexion->query("SELECT refProducto FROM ventas WHERE codComercial = $code"));
    $referencia = $ref->fetchColumn();
    $refeacortada = substr($referencia,0,2);
    $sql = "SELECT * FROM productos WHERE referencia LIKE '$refeacortada%'";
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
            echo "<td> <input type='text' name='nombrepro' placeholder='" . $row["nombre"] . "'> </td>";
            echo "<td> <input type='text' name='descripcion' placeholder='" . $row["descripcion"] . "'> </td>";
            echo "<td> <input type='text' name='precio' placeholder='" . $row["precio"] . "'> </td>";
            echo "<td> <input type='text' name='descuento' placeholder='" . $row["descuento"] . "'> </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros";
    }

    echo "<br>";
    // TERCERA TABLA - VENTAS
    $sql = "SELECT * FROM ventas WHERE codComercial = $code";
    $result = $conexion->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table border='1'><caption>VENTAS</caption>
                <tr>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td> <input type='text' name='cantidad' placeholder='" . $row["cantidad"] . "'> </td>";
            echo "<td> <input type='date' name='fecha' placeholder='" . $row["fecha"] . "'> </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros";
    }

    // Cierre del formulario debe ir aquí, una vez que se han mostrado todas las tablas.
    echo "<br>
            <input type='text' name='refcode' style='display:none' value='$referencia'>
            <input type='text' name='code2' style='display:none' value='$code' displa>
            <input type='submit' value='Asignar'></form>";

    $conexion = null;
}

function modificarDatos()
{

    $code = (int) $_POST["code2"];
    $refcod = $_POST["refcode"];
    $conexion = conectarDB();

    $updateFields = array(
        'comerciales' => array('nombre', 'salario', 'hijos', 'fNacimiento'),
        'productos' => array('nombrepro', 'descripcion', 'precio', 'descuento'),
        'ventas' => array('cantidad', 'fecha')
    );

    foreach ($updateFields as $table => $fields) {
        $updates = array();
        foreach ($fields as $field) {

            if (!empty($_POST[$field])) {

                if ($field === 'fNacimiento') {
                    $fecha = $_POST['fNacimiento'];
                    if (!validarFecha($fecha)) {
                        echo "Formato de fecha no válido. Utiliza YYYY-MM-DD.";
                    } else {
                        $value = $_POST[$field];
                        $updates[] = "$field = '$value'";
                    }
                }elseif($field === 'fecha'){
                    $fecha = $_POST['fecha'];
                    if (!validarFecha($fecha)) {
                        echo "Formato de fecha no válido. Utiliza YYYY-MM-DD.";
                    }else{
                        $value = $_POST[$field];
                        $updates[] = "$field = '$value'";
                    }
                }else {
                    $value = $field === 'hijos' ? (int) $_POST[$field] :
                            ($field === 'salario' ? sprintf("%.2f", (float) str_replace(',', '', $_POST[$field])) : 
                            ($field === 'precio' ? sprintf("%.2f", (float) str_replace(',', '', $_POST[$field])) :
                            ($field === 'cantidad' ? (int)$_POST[$field] : $_POST[$field])));
                    $updates[] = "$field = '$value'";
                }
            }
    }

        if (!empty($updates)) {
            if($table === "productos"){
                $sql = "UPDATE $table SET " . implode(', ', $updates) . " WHERE referencia = '$refcod'";
            }elseif($table === "comerciales"){
                $sql = "UPDATE $table SET " . implode(', ', $updates) . " WHERE codigo = $code";
            }else{
                $sql = "UPDATE $table SET " . implode(', ', $updates) . " WHERE codComercial = $code";
            }
            $conexion->exec($sql);
        }
    }
}


function validarFecha($fecha)
{
    // Expresión regular para el formato YYYY-MM-DD
    $patron = "/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/";
    return preg_match($patron, $fecha);
}

function comprobadorPorciento($porciento){

    if($porciento > 100 | $porciento < 0){
        echo "El porcentaje introducido no es válido";
    }else{
        return $porciento;
    }
}
