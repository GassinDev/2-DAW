
<?php

    class Product{
        public $name;
        public $price;
        public $amount;

        function __construct($name,$price,$amount){
            $this -> name = $name;
            $this -> price = $price;
            $this -> amount = $amount;
        }

        function get_name(){
            return $this -> name;
        }

        function get_price(){
            return $this -> price;
        }

        function get_amount(){
            return $this -> amount;
        }
        
    }

    $p1 = new Product("Bocadillo",3.4,2);

    $arrayObjetos = [$p1];

    function showList($arrayObjetos){

        $parte1 = "<table border='2'>";

        for($i = 0; $i < count($arrayObjetos);$i++){
            $parte1 += "<tr><td>{get_name()}</td>";
        }

    return $parte1;
    }

    function insert(){

    }

    function modify(){

    }

    function delete(){

    }

    function calculateTotalPriceProduct(){

    }

    function calculateTotalPurchasePrice(){
        
    }
?>