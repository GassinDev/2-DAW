<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $sumaDePrimos = 0;
    
        for($i = 2; $i < 100;$i++){

            if(esPrimo($i)){
                $sumaDePrimos += $i;
            }
        }

        echo $sumaDePrimos;
        
        function esPrimo($numero)
        {
            for ($i = 2; $i < $numero; $i++) {
                
                if (($numero % $i) == 0) {
                    return false;
                }
            }
            return true;
        }
    ?>
</body>
</html>