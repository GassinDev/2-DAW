<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Plantilla para Ejercicios Tema 3</title>
	<link href="dwes.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="encabezado">
		<h1>Ejercicio:</h1>
		<form action="plantilla.php" method="post">
			<input type="text" name="cod" id="name">
			<input type="submit" value="name">
		</form>
	</div>

	<div id="contenido">
		<h2>Contenido</h2>
		<?php
		include("function.php");

		if(isset($_POST["cod"])){
			$name = $_POST["cod"];
			verDatos($name);
		}
		?>
	</div>

	<div id="pie">
	</div>
</body>

</html>