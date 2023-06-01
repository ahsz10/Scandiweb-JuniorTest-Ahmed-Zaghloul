<?php

    class DVD extends Product{
        private $size;

        // Constructor
        public function __construct($SKU, $name, $price, $type, $attributes) {
            parent::__construct($SKU, $name, $price, $type);
            $this->size = $attributes;
        }

        // Getter and setter for Size
        private function getSize(){
            return $this->size;
        }

        private function setSize($size){
            $this->size = $size;
        }

        // Method to insert new DVD attributes to the database 
        protected function saveProductAttributes($id){
            $sql = "insert into dvd (id, size) values(:id, :size)";
            $insert= self::$pdo->prepare($sql);
            $insert->bindParam(':id',$id);
            $insert->bindParam(':size',$this->size);
            $insert->execute(); 
        }

    }

?>


