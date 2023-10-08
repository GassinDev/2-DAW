<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function eliminarRepetidos($list1) {
            $nums_unique = array_values(array_unique($list1));
            return $nums_unique ;
          }
          $nums = array(1,1,2,2,3,4,5,5);
          print_r(remove_duplicates_list($nums));
    ?>
</body>
</html>