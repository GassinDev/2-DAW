<?php

function conectarDB()
{

    $servername = "localhost";
    $database = "dwes";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function verDatos()
{
    $conn = conectarDB();

    $sql = "SELECT * FROM stock";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>producto</th>
                    <th>tienda</th>
                    <th>unidades</th>
                </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row["producto"] . "</td>";
            echo "<td>" . $row["tienda"] . "</td>";
            echo "<td>" . $row["unidades"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron registros";
    }
    $conn->close();
}

// function verDatosEspecificos($name)
// {
//     $conn = conectarDB();

//     $sql = "SELECT * FROM stock WHERE producto = '$name'";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         echo "<table border='1'>
//                 <tr>
//                     <th>tienda</th>
//                     <th>unidades</th>
//                 </tr>";

//         while ($row = mysqli_fetch_array($result)) {
//             echo "<tr>";
//             echo "<td>" . $row["tienda"] . "</td>";
//             echo "<td>" . $row["unidades"] . "</td>";
//             echo "</tr>";
//         }

//         echo "</table>";
//     } else {
//         echo "No se encontraron registros";
//     }
//     $conn->close();
// }

function verModificar($name)
{
    $conn = conectarDB();

    $sql = "SELECT * FROM stock WHERE producto = '$name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<br>  <form action='plantilla.php' method='post'>
            SUCURSAL " . $row["tienda"] . ", UNIDADES:
            <input type='hidden' name='producto' id='producto' value='" . $row["producto"] . "'>
            <input type='hidden' name='tienda' id='tienda' value='" . $row["tienda"] . "'>
            <input type='text' name='unidades' id='unidades' placeholder='" . $row["unidades"] . "'>
            <input type='submit' value='modificar'>
            </form>";
        }

    } else {
        echo "No se encontraron registros";
    }

    $conn->close();
}

function modificar(){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = conectarDB();

        $producto = mysqli_real_escape_string($conn, $_POST["producto"]);
        $tienda = mysqli_real_escape_string($conn, $_POST["tienda"]);
        $unidades = (int)$_POST["unidades"];

        $sql = "UPDATE stock SET unidades = $unidades WHERE tienda = '$tienda' AND producto = '$producto'";
        if ($conn->query($sql) === TRUE) {
            echo "Actualización exitosa";
        } else {
            echo "Error al actualizar la base de datos: " . $conn->error;
        }

        $conn->close();
    }
}
