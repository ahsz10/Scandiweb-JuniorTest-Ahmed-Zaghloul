<?php
    require '../Database/Connect_DB.php';

    abstract class Product {
        private $SKU;
        private $name;
        private $price;
        private $type;
        static protected $pdo;

        // Method to connect to the database and save pdo in the class
        static public function set_database($pdo){
            self::$pdo = $pdo;
        }

        // public function __construct( ) { 
        //     echo"ahmed is here";
        // }

        // Constructor
        public function __construct($SKU, $name, $price, $type) {
            $this->SKU = $SKU;
            $this->name = $name;
            $this->price = $price;
            $this->type = $type;
        }
        
        // Getter and setter for SKU
        public function getSKU(){
            return $this->SKU;
        }
        
        protected function setSKU(string $SKU){
            $this->SKU = $SKU;
        }

        // Getter and setter for Name
        protected function getName(){
            return $this->name;
        }

        protected function setName(string $name){
            $this->name = $name;
        }

        // Getter and setter for Price
        protected function getPrice(){
            return $this->price;
        }
        
        protected function setPrice($price){
            $this->price = $price;
        }

        // Getter and setter for Type
        protected function getType(){
            return $this->type;
        }

        protected function setType(string $type){
            $this->type = $type;
        }


        // Method to insert new product default attributes to the database 
        protected function saveProduct(){

            $sql = "insert into products (sku, name, price, type) 
                    values(:sku,:name,:price,:type)";
            $insert= self::$pdo->prepare($sql);
            $insert->bindParam(':sku',$this->SKU);
            $insert->bindParam(':name',$this->name);
            $insert->bindParam(':price',$this->price);
            $insert->bindParam(':type',$this->type);
            $insert->execute();

            return self::$pdo->lastInsertId();
        }
        // Abstract method to insert new product attributes to the database 
        abstract protected function saveProductAttributes($id);

        // Method to retrieve all existing products from the database
        public function getProducts(){

            //USe COALESCE() function to return only the type-specific attribute with a value (not null)
            $sql = "SELECT p.*, COALESCE(concat ('Weight: ', b.weight, ' KG'), concat ('Size: ', d.size, ' MB'), concat ('Dimensions: ', f.height, 'x', f.width, 'x', f.length, ' CM')) AS attributes FROM products p LEFT JOIN book b ON p.id = b.id LEFT JOIN dvd d ON p.id = d.id LEFT JOIN furniture f ON p.id=f.id ORDER BY p.id";
            $stmt = self::$pdo->query($sql);
            $products = $stmt->fetchAll();

            return $products;
        }

        // Method to delete selected products from the database
        protected function deleteProduct($SKU){
            $sql = "DELETE FROM products WHERE sku= :sku";
            $delete=self::$pdo->prepare($sql);
            $delete->bindParam(':sku', $SKU);
            $delete->execute();
        }

        // Method to check if SKU already exists in the database
        public function skuExists($SKU){
            $sql = "SELECT COUNT(*) FROM products WHERE sku = :sku";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindParam(':sku', $SKU);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if($count > 0) {
                return true;
            } else {
                return false;
            }
        }

    }

?>