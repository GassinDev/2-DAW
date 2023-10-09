<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function eliminarRepetidos($array)
    {
        $arraySinRe = array_values(array_unique($array));
        return $arraySinRe;
    }

    $nums = array(1, 1, 2, 2, 3, 4, 5, 5);
    print_r(eliminarRepetidos($nums));

    ?>
</body>

</html>