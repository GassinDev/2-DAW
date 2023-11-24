<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>INICIO</h1>  
    <h2>INICIO SESIÓN PARA ENTRAR EN TU MENÚ Y TRABAJAR CON LA BASE DE DATOS</h2>
    <form action="usuario.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password">
        <br>
        <input type="submit" value="INICIAR">
    </form>

    
    <?php
        // Verificar si tanto el nombre de usuario como la contraseña están establecidos en la solicitud POST
        if(isset($_POST["username"]) && isset($_POST["password"])){
            // Verificar si el nombre de usuario y la contraseña ingresados coinciden con los valores esperados
            if($_POST["username"] === "dwes" && $_POST["password"] === "dwes"){
                // Si las credenciales son correctas, redirigir a "index.php"
                header('Location: index.php');
            }else{
                // Si las credenciales son incorrectas, mostrar un mensaje de error
                echo'<p>Usuario no autorizado</p>';
            }
        }
    ?>
    
</body>

</html>