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
        if(isset($_POST["username"]) && isset($_POST["password"])){
            if($_POST["username"] === "dwes" && $_POST["password"] === "dwes"){
                header('Location: index.php');
            }else{
                echo'<p>Usuario no autorizado</p>';
            }
        }
    ?>
</body>

</html>