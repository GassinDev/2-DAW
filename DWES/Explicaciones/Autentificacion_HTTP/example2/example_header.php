<!DOCTYPE html>
<html lang="en">

<?php
    if (!isset($_SERVER['PHP_AUTH_USER'])){
        header('WWW-Authenticate: Basic Realm="Contenido Restringido"');
        header('HTTP/1.0 401 Unauthorized');
        echo "Usuario no reconocido";
        exit;
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example header Htpp auth</title>
</head>
<body>
    <?php
        if (isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW'])){
            echo "Nombre usuario: ".$_SERVER['PHP_AUTH_USER']."<br/>";
            echo "Pass: ".$_SERVER['PHP_AUTH_PW']."<br/>";
        }
        else
            echo "User not auth";
    ?>
</body>
</html>