<?php
// include 'Product.php';
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
            // $sql0 ="SELECT MAX(id) FROM products";
            // $stmt = $this->connectDB()->prepare($sql0);
            // $stmt->execute();
            // // Fetch the result
            // $result = $stmt->fetch(PDO::FETCH_ASSOC);
            // // Access the maximum id value
            // $max_id = $result['MAX(id)'];
            // $max_id = $stmt->fetchColumn();
            // echo "<br>the sql result in table products is ".$result."<br>";
            // echo "<br>the sql max index in table products is ".$max_id."<br>";
            // echo "<br>the the incoming id ".$id."<br>";
            // echo "<br>the last index in table products from dvd ".$this->connectDB()->lastInsertId()."<br>";

            $sql = "insert into dvd (id, size) values(:id, :size)";
            // $insert= self::$pdo->prepare($sql);
            // echo '<br><br><br><br> in dvd save attribute';
            // echo '<br> <strong> id coming from last index is '.$id.'</strong><br>';
            $insert= $this->connectDB()->prepare($sql);
            // $insert->bindParam(':id',$id);
            $insert->bindParam(':id',$id);
            $insert->bindParam(':size',$this->size);
            // echo '<br><br><br><br><br><br>';
            $insert->execute(); 
            // echo '<br> after excute ';
        }

    }

?>


