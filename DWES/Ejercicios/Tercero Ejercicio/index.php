<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Seleccione su idioma</h1>


    <form method="post" action="index.php">
        <select name="idioma" id="idoEle">
            <option value="english">Inglés</option>
            <option value="spanish">Español</option>
        </select>
        <input type="submit" name="submit" value="Enviar">
    </form>


    <form method="post" action="index.php">
        <select name="foto" id="fotoElegida">
            <option value="mono">Mono</option>
            <option value="gato">Gato</option>
            <option value="perro">Perro</option>
        </select>
        <input type="submit" name="submit2" value="Enviar">
    </form>

    <?php
        if(isset($_POST['submit'])){

            $opcElegida = $_POST['idioma'];
            setcookie('idioma',$opcElegida,time() + (3600 * 24), "/");
            header('Location: ' . $_SERVER['PHP_SELF']);

        }elseif(isset($_POST['submit2'])){

            $fotoElegida = $_POST['foto'];
            setcookie('foto',$fotoElegida,time() + (3600 * 24), "/");
            header('Location: ' . $_SERVER['PHP_SELF']);

        }

        $idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'spanish';
        $foto = isset($_COOKIE['foto']) ? $_COOKIE['foto'] : 'mono';

        if($idioma === 'english'){
            include('contenidoEN.php');
        }else{
            include('contenidoES.php');
        }

        if($foto === 'mono'){
            include('mono.php');
        }elseif($foto === 'gato'){
            include('gato.php');
        }else{
            include('perro.php');
        }
    ?>
</body>
</html>