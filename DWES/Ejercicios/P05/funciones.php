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

//WE CREATE THE CLASS Usuario
class Usuario
{
    public $id;
    public $username;
    public $password;
    public $email;

    function __construct($id, $username, $password, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    function getId()
    {
        return $this->id;
    }

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

}


//FORMS FOR THE FUNCTIONS OF THE WEBSITE
function formAlta()
{
    echo "<h2>Da de alta a un usuario</h2>
    <form action='aplicacion.php' method='post'>
    <label for='usuario'>Usuario:</label>
    <input type='text' id='usuario' name='usuario' required>
    <br>
    <label for='email'>Email:</label>
    <input type='email' id='email' name='email' required>
    <br>
    <label for='contrasena'>Contraseña:</label>
    <input type='password' id='contrasena' name='contrasena' required>
    <br>
    <label for='contrasena'>Repetir Contraseña:</label>
    <input type='password' id='repecontrasena' name='repecontrasena' required>
    <br>
    <button type='submit' name='darAlta'>Dar de Alta</button>
    </form>";
}

function formBuscaModificar()
{

    echo "<h2>Busca el usuario que quieres modificar</h2>
    <form action='aplicacion.php' method='post'>
    <label for='usuario'>Usuario:</label>
    <input type='text' id='usuario' name='usuario' required>
    <button type='submit' name='BuscarModi'>Buscar</button>
    </form>";
}

function formModificar($usuario)
{
    echo "<h2>Modifica el usuario</h2>
    <form action='aplicacion.php' method='post'>
    <label for='usuario'>Usuario:</label>
    <input type='text' id='usuario' name='usuario' value='". $usuario->getUsername()."'required>
    <br>
    <label for='contrasena'>Contraseña:</label>
    <input type='password' id='contrasena' name='contrasena'required>
    <br>
    <label for='contrasena'>Repetir Contraseña:</label>
    <input type='password' id='repecontrasena' name='repecontrasena' required>
    <br>
    <label for='email'>Email:</label>
    <input type='email' id='email' name='email' value='". $usuario->getEmail(). "'required>
    <br>
    <button type='submit' name='modificarDatos'>Dar de Alta</button>
    </form>";
}
function formEliminar()
{

    echo "<h2>Elije el usuario que quieres eliminar</h2>";

    $arrayUsuarios = creaArrayUsuarios();

    // Verificar si el array de usuarios no está vacío
    if (!empty($arrayUsuarios)) {
        
        echo '<form action="aplicacion.php" method="post">';

        echo '<select name="usuarios">';

        foreach ($arrayUsuarios as $usuario) {

            if($usuario->getUsername() !== $_SESSION['usuario']) {
                echo '<option value="' . $usuario->getUsername() . '">' . $usuario->getUsername() . '</option>';
            }
            
        }

        echo '</select>';

        echo ' <input type="submit" name="eliminarUsuario" value="Eliminar">';

        echo '</form>';
    } else {

        echo 'No hay usuarios disponibles.';
    }
}
function verDatos()
{
    $usuarios = creaArrayUsuarios();

    // Iterate through the array and do something
    foreach ($usuarios as $usuario) {
        // Access individual properties of $usuario
        $id = $usuario->getId();
        $nombre = $usuario->getUsername();
        $contrasena = $usuario->getPassword();
        $email = $usuario->getEmail();

        // Do something with the user data
        echo "ID: $id, Nombre: $nombre, Contraseña: $contrasena, Email: $email<br>";
    }
}

function darAlta()
{

    $arrayUsuarios = creaArrayUsuarios();

    $nombre = $_POST['usuario'];
    $password = $_POST['contrasena'];
    $repPassword = $_POST['repecontrasena'];
    $email = $_POST['email'];

    if (validacionUsuario($nombre, $password, $repPassword)) {

        $id = generarId($arrayUsuarios);

        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $usuario = new Usuario($id, $nombre, $hash, $email);

        $conexion = conectarDB();

        // Using a prepared statement to prevent SQL injection
        $sql = "INSERT INTO usuarios (id, usuario, pwd, email) VALUES (:id, :usuario, :pwd, :email)";

        $statement = $conexion->prepare($sql);

        $id = $usuario->getId();
        $usu = $usuario->getUsername();
        $contrasena = $usuario->getPassword();
        $email = $usuario->getEmail();

        // Bind parameters
        $statement->bindParam(':id', $id);
        $statement->bindParam(':usuario', $usu);
        $statement->bindParam(':pwd', $contrasena);
        $statement->bindParam(':email', $email);

        // Execute the query
        $result = $statement->execute();

        // Check for success
        if ($result) {
            echo '<br>';
            echo "Usuario dado de alta con éxito.";
        } else {
            echo "Error al dar de alta al usuario.";
        }
    }

}
function creaArrayUsuarios()
{

    $arrayUsuarios = array();

    $conexion = conectarDB();

    $sql = "SELECT * FROM usuarios";
    $result = $conexion->query($sql);

    if ($result->rowCount() > 0) {

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $id = $row["id"];
            $nombre = $row["usuario"];
            $contrasena = $row["pwd"];
            $email = $row["email"];

            $usuario = new Usuario($id, $nombre, $contrasena, $email);

            $arrayUsuarios[] = $usuario;

        }
    }

    return $arrayUsuarios;
}

function modificarUsuario(){

    $nombre = $_POST['usuario'];
    $password = $_POST['contrasena'];
    $repPassword = $_POST['repecontrasena'];
    $email = $_POST['email'];

    if (validacionUsuario($nombre, $password, $repPassword)) {
        
        $usuario = buscaDatosUsuario();

        $conexion = conectarDB();

        // Using a prepared statement to prevent SQL injection
        $sql = "UPDATE usuarios SET pwd = :pwd, SET usuario = :usuario, SET email = :email WHERE id = :id";

        $statement = $conexion->prepare($sql);

        $id = $usuario->getId();
        $usu = $usuario->getUsername();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $email = $usuario->getEmail();

        // Bind parameters
        $statement->bindParam(':id', $id);
        $statement->bindParam(':usuario', $usu);
        $statement->bindParam(':pwd', $hash);
        $statement->bindParam(':email', $email);

        // Execute the query
        $result = $statement->execute();

        // Check for success
        if ($result) {
            echo '<br>';
            echo "Usuario modificado con éxito.";
        } else {
            echo '<br>';
            echo "Error al modificar el usuario.";
        }
    }

}

function eliminarUsuario(){

    $usu = $_POST["usuarios"];

    $conexion = conectarDB();

        $sql = "DELETE FROM usuarios WHERE usuario = :usuario";

        $statement = $conexion->prepare($sql);

        // Bind parameters
        $statement->bindParam(':usuario', $usu);

        // Execute the query
        $result = $statement->execute();

        // Check for success
        if ($result) {
            echo '<br>';
            echo "Usuario eliminado con éxito.";
        } else {
            echo "Error al eliminar el usuario.";
        }
}

function generarId($arrayUsuarios)
{

    $id = 1;

    // Find an available ID
    foreach ($arrayUsuarios as $usuario) {
        if ($id == $usuario->getId()) {
            $id++;
        } else {
            // Break the loop once an available ID is found
            break;
        }
    }
    return $id;
}

function buscaDatosUsuario(){

    $arrayUsuarios = creaArrayUsuarios();
    $usernameSele = $_POST['usuario'];

    foreach ($arrayUsuarios as $usuario) {
        if ($usuario->getUsername() === $usernameSele) {
            return $usuario;

        }
    }
}

function validacionUsuario($usu, $password, $repPassword)
{

    $arrayUsuarios = creaArrayUsuarios();
    $valido = true;

    foreach ($arrayUsuarios as $usuario) {
        if ($usu === $usuario->getUsername()) {
            $valido = false;
            echo "<br>";
            echo "Este usuario ya está registrado, pruebe con otro.";
            break;
        }
    }

    if ($password !== $repPassword) {
        $valido = false;
        echo "<br>";
        echo "Contraseñas diferentes en los dos campos.";
    }

    return $valido;
}

?>