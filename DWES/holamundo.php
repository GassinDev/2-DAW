<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=º, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo '<p>Hola mundo</p>';
        $coches = 3;
        $resul = 0;
        //comentario
        echo $coches;

        /*
        Mas de una linea
        */
        echo '<p></p>';
        echo $COCHES = 2;

        for($coches; $coches < 9; $coches++){

            $resul = $resul + 1;
            echo $resul;
        }

        class Car{
            public $color;
            public $model;
            public function __construct($color,$model){
                $this->color = $color;
                $this->model = $model;
            }

            public function message(){
                return "The car is " . $this->color . " ".$this->model. " ";
            }
        }

        $car1 = new Car("gris","Audi");
        echo $car1->message();
    ?>
</body>
</html>