<?php

//Inicamos la session
session_start();

//Aqui comprobamos si nuestro array para guardar los productos existe, sino lo creamos.
if (!isset($_SESSION['arrayObjetos'])) {
    $_SESSION['arrayObjetos'] = array();
}

//Creamos la clase Product
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

//Función que saca los datos del array de la session gracias a los get y set y vamos
//añadiendolos en las filas de una tabla.
function showList()
{
    //Accedemos a la variable de nuestra session para utilizarlo en la función como otra variable.
    $arrayObjetos = $_SESSION['arrayObjetos'];

    //Si encuentra alguna posición en el array comenzamos a crear una tabla 
    if (!empty($arrayObjetos)) {

        $parte1 =
            "<table border='2'><caption>LISTA DE PRODUCTOS<caption> 
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>";

        $precioTotal = 0;

        foreach ($arrayObjetos as $producto) {
            //Variable donde calculamos el total de un producto
            $totalCP = $producto->getPrice() * $producto->getAmount();
            //Variable que almacena el total de cada producto para tener el completo de nuestra lista.
            $precioTotal += $totalCP;

            $parte1 .= "<tr>
                            <td>{$producto->getName()}</td>
                            <td>{$producto->getPrice()}€</td>
                            <td>{$producto->getAmount()}</td>
                            <td>{$totalCP}€</td>
                        </tr>";
        }

        $tabla = $parte1 . "<td COLSPAN=4>Precio total - Lista de Productos: {$precioTotal}€</td>
                            </table>";

        echo $tabla;

    } else {
        echo "No hay ningún producto añadido a tu lista.";
    }
}

//Las 4 funciones siguientes son simples echo, los cuales son formularios.
function showFormInsert()
{
    echo "<h2>Introduce un producto</h2>
            <form method='post' action='index.php'>
                Nombre: <input type='text' name='name' required><br>
                Precio:<input type='number' name='price' step='any' required><br>
                Cantidad: <input type='number' name='amount' required><br>
                <input type='submit' value='Insertar'>
            </form>";
}

function showFormModify()
{
    echo "<h2>Modifica un producto</h2>
            <form method='post' action='index.php'>
                Nombre del Producto: <input type='text' name='name4' required><br>
                Nombre nuevo: <input type='text' name='name2'><br>
                Precio nuevo:<input type='number' name='price2' step='any'><br>
                Cantidad nueva: <input type='number' name='amount2'><br>
                <input type='submit' value='Modificar'>
            </form>";
}

function showFormDelete()
{
    echo "<h2>Eliminar un producto</h2>
            <form method='post' action='index.php'>
                Nombre: <input type='text' name='name3' required><br>
                <input type='submit' value='Eliminar'>
            </form>";
}

//La función que hace que podamos meter datos en nuestra lista.
function insert()
{
    //Comprobamos si se ha recibido los datos del formulario.
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['amount'])) {

        if (productoEncontrado($_POST['name'])) {
            return false;
        } else {
            //Guardamos los datos recogidos en varibales-
            $name = $_POST['name'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];

            //Creamos un producto con nuestra clase Product, añdiendo las variables creadas.
            $product = new Product($name, $price, $amount);
            //Por último, introducimos el producto en nuestra lista.
            $_SESSION['arrayObjetos'][] = $product;

            return true;
        }
    }
}

function modify()
{
    $cont = 0;
    //Comprobamos si se ha recibido los datos del formulario.
    if (isset($_POST['name4'])) {

        $name2 = $_POST['name4'];
        $arrayObjetos = $_SESSION['arrayObjetos'];

        if(productoEncontrado($name2)){
            //Buscamos el producto por su nombre en nuestro array
        foreach ($arrayObjetos as $productos) {

            $n = $productos->getName();

            if (strtoupper($n) === strtoupper($name2)) {

                if (isset($_POST['name2']) | isset($_POST['price2']) | isset($_POST['amount2'])) {
                    $name = $_POST['name2'];
                    $price = $_POST['price2'];
                    $amount = $_POST['amount2'];

                    //Los tres IF siguientes son filtros para saber si hay datos o no, porque si no
                    //hay nada cambiado en uno de ellos, no se asigna nada nuevo y permanece los datos antiguos.
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
    //Comprobamos si se ha recibido los datos del formulario.
    if (isset($_POST['name3'])) {

        $name = strtoupper($_POST['name3']);
        $arrayObjetos = $_SESSION['arrayObjetos'];

        //Buscamos el producto en nuestro array y cuando lo encontremos lo eliminamos
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

//Función para buscar si el producto se encuentra en el array
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