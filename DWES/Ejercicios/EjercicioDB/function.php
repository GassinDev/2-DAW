<?php

function verDatos($name)
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
    echo "Connected successfully";

    $sql = "SELECT * FROM stock WHERE producto = '$name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>tienda</th>
                    <th>unidades</th>
                </tr>";

        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
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

?>