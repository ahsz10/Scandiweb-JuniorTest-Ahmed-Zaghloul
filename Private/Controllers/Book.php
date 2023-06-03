<?php
    class Book extends Product{
        private $weight;

        // Constructor
        public function __construct($SKU, $name, $price, $type, $attributes) {
            parent::__construct($SKU, $name, $price, $type);
            $this->weight = $attributes;
        }

        // Getter and setter for Weight
        private function getWeight(){
            return $this->weight;
        }

        private function setWeight($weight){
            $this->weight = $weight;
        }

        // Method to insert new Book attributes to the database 
        protected function saveProductAttributes($id){            
            $sql = "insert into book (id, weight) values(:id, :weight)";
            // $insert= self::$pdo->prepare($sql);
            echo 'in book save attributes';
            $insert= $this->connectDB()->prepare($sql);
            $insert->bindParam(':id',$id);
            $insert->bindParam(':weight',$this->weight);
            $insert->execute();
        }

        
    }
?>