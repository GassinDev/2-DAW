<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>PREFERENCIAS</h1>
    <form action="preferencia.php" method="post">
        <label for="color">Selecciona un color:</label>
        <select id="color" name="color">
            <option value="green">Verde 🟢</option>
            <option value="red">Rojo 🔴</option>
            <option value="purple">Morado 🟣</option>
            <option value="yellow">Amarillo 🟡</option>
        </select>
        <input type="submit" value="Aplicar">
    </form>
    <br>
    <form action="preferencia.php" method="post">
        <input type="submit" value="Restablecer preferencias" name="restablecer">
    </form>
    <br>
    <a href="index.php">Volver al login</a>
    <style>
        select {
            font-size: 16px; 
            padding: 5px;    
        }
    </style>
    <?php
        include("funciones.php");
        session_start();

        //CREA LA COOKIE CON EL RESPECTIVO COLOR ELEGIDO
        if (isset($_POST['color'])) {
            $color = $_POST['color'];
            setcookie('colorFondo', $color, time() + 3600, "/"); 
            header("Location: preferencia.php");
            exit();
        }
        
        //APLICA LA COOKIE PARA CAMBIAR EL COLOR DEL FONDO
        if (isset($_COOKIE['colorFondo'])) {
            $color = $_COOKIE['colorFondo'];
            echo "<style>body { background-color: $color; }</style>";
        }
        
        //ELIMINAR LA COOKIE
        if (isset($_POST['restablecer'])) {
            borrarCookie('colorFondo');
            header("Location: preferencia.php");
            exit();
            }

    ?>
</body>
</html>