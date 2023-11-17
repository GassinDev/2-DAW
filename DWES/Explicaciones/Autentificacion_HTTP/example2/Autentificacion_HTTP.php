<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo: Autentificación HTTP -->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>
Ejemplo Tema 4: Autentificación HTTP
</title>
</head>
<body>
<?php
if (isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW']) and isset($_SERVER['AUTH_TYPE'])){
	echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
	echo "Contraseña: ".$_SERVER['PHP_AUTH_PW']."<br />";
	echo "Método de autentificación: ".$_SERVER['AUTH_TYPE']."<br />";
}
else
	echo "No se ha autentificado";
?>
</body>
</html>