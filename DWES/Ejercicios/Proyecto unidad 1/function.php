<?php

//We start the session.
session_start();

//Here we check if our array to store the products exists, if not we create it.
if (!isset($_SESSION['arrayObjetos'])) {
    $_SESSION['arrayObjetos'] = array();
}

//We create the Product class
class Product
{
    public $name;
    public $price;
    public $amount;

    function __construct($name, $price, $amount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }

    function getName()
    {
        return $this->name;
    }

    function getPrice()
    {
        return $this->price;
    }

    function getAmount()
    {
        return $this->amount;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function setAmount($amount)
    {
        $this->amount = $amount;
    }
}

// Function that retrieves data from the session array using get and set,
// and progressively adds them to the rows of a table.
function showList()
{
    // Access the variable from our session to use it in the function as another variable.
    $arrayObjetos = $_SESSION['arrayObjetos'];

    // If a position is found in the array, we start creating a table.
    if (!empty($arrayObjetos)) {

        $parte1 =
            "<div class='container' ><table class='table'><thead class='table-dark'>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr></thead>";

        $precioTotal = 0;

        foreach ($arrayObjetos as $producto) {
            // Variable where we calculate the total of a product
            $totalCP = $producto->getPrice() * $producto->getAmount();
            // Variable that stores the total for each product to have the complete total of our list
            $precioTotal += $totalCP;

            $parte1 .= "<tr>
                            <td>{$producto->getName()}</td>
                            <td>{$producto->getPrice()}€</td>
                            <td>{$producto->getAmount()}</td>
                            <td>{$totalCP}€</td>
                        </tr>";
        }
        $tabla = $parte1 . "<td COLSPAN=4>Precio total - Lista de Productos: {$precioTotal}€</td>
                            </table></div>";

        echo $tabla;

    } else {
        echo "No hay ningún producto añadido a tu lista.";
    }
}

// The following 4 functions are simple echoes, which are forms.
function showFormInsert()
{
    echo "<h2>Introduce un producto</h2>
            <form method='post' action='index.php'>
                Nombre: <input  class='form-control' type='text' name='name' required><br>
                Precio:<input class='form-control' type='number' name='price' step='any' required><br>
                Cantidad: <input class='form-control' type='number' name='amount' required><br>
                <input class='btn btn-primary' type='submit' value='Insertar'>
            </form>";
}

function showFormModify()
{
    echo "<h2>Modifica un producto</h2>
            <form method='post' action='index.php'>
                Nombre del Producto: <input class='form-control' type='text' name='name4' required><br>
                Nombre nuevo: <input class='form-control' type='text' name='name2'><br>
                Precio nuevo:<input class='form-control' type='number' name='price2' step='any'><br>
                Cantidad nueva: <input class='form-control' type='number' name='amount2'><br>
                <input class='btn btn-primary' type='submit' value='Modificar'>
            </form>";
}

function showFormDelete()
{
    echo "<h2>Eliminar un producto</h2>
            <form method='post' action='index.php'>
                Nombre: <input class='form-control' type='text' name='name3' required><br>
                <input class='btn btn-primary' type='submit' value='Eliminar'>
            </form>";
}

// Function that allows us to input data into our list
function insert()
{
    // Check if the form data has been received
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['amount'])) {

        if (productoEncontrado($_POST['name'])) {
            return false;
        } else {
            // Save the collected data in variables
            $name = $_POST['name'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];

           // Create a product using our Product class, adding the created variables
            $product = new Product($name, $price, $amount);
            // Finally, we add the product to our list
            $_SESSION['arrayObjetos'][] = $product;

            return true;
        }
    }
}

function modify()
{
    $cont = 0;
    // Check if the form data has been received
    if (isset($_POST['name4'])) {

        $name2 = $_POST['name4'];
        $arrayObjetos = $_SESSION['arrayObjetos'];

        if(productoEncontrado($name2)){
            // Search for the product by its name in our array
        foreach ($arrayObjetos as $productos) {

            $n = $productos->getName();

            if (strtoupper($n) === strtoupper($name2)) {

                if (isset($_POST['name2']) | isset($_POST['price2']) | isset($_POST['amount2'])) {
                    $name = $_POST['name2'];
                    $price = $_POST['price2'];
                    $amount = $_POST['amount2'];

                    // The following three IF statements are filters to check if there is data or not,
                    // because if nothing has changed in one of them, no new data is assigned,
                    // and the old data remains.
                    if ($name !== "") {
                        $productos->setName($name);
                    }

                    if ($price !== "") {
                        $productos->setPrice($price);
                    }

                    if ($amount !== "") {
                        $productos->setAmount($amount);
                    }

                    $cont++;
                    return true;
                }
            }
        }
        }else{
            return false;
        }
    }
}

function delete()
{
    // Check if the form data has been received
    if (isset($_POST['name3'])) {

        $name = strtoupper($_POST['name3']);
        $arrayObjetos = $_SESSION['arrayObjetos'];

        // Search for the product in our array, and when found, remove it
        foreach ($arrayObjetos as $key => $productos) {
            $n = strtoupper($productos->getName());

            if ($n === $name) {

                unset($arrayObjetos[$key]);

                $arrayObjetos = array_values($arrayObjetos);

                $_SESSION['arrayObjetos'] = $arrayObjetos;

                return true;
            }
        }
    }
}

// Function to search if the product is in the array
function productoEncontrado($pro)
{
    $pro = strtoupper($pro);
    $arrayObjetos = $_SESSION['arrayObjetos'];

    foreach ($arrayObjetos as $productos) {
        $n = strtoupper($productos->getName());

        if ($n === $pro) {
            return true;
        }
    }
}
?>