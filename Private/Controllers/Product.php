<?php
    abstract class Product {
        private $SKU;
        private $name;
        private $price;
        private $type;

        // Constructor
        public function __construct($SKU, $name, $price, $type) {
            $this->SKU = $SKU;
            $this->name = $name;
            $this->price = $price;
            $this->type = $type;
        }

        // Method to connect to the database
        protected function connectDB(){
            try {
                $username = 'root';
                $password = '';
                $pdo = new PDO ('mysql:host=localhost;dbname=scandiweb_test',$username,$password);
                return $pdo;
            } catch (PDOException $e) {
                print "Error:" . $e->getMessage() . "</br>";
                die();
            }
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
            $insert= $this->connectDB()->prepare($sql);
            $insert->bindParam(':sku',$this->SKU);
            $insert->bindParam(':name',$this->name);
            $insert->bindParam(':price',$this->price);
            $insert->bindParam(':type',$this->type);
            $insert->execute();
            
            $indexSql ="SELECT MAX(id) FROM products";
            $index = $this->connectDB()->prepare($indexSql);
            $index->execute();
            $lastIndex = $index->fetchColumn();

            return $lastIndex;
        }
        // Abstract method to insert new product attributes to the database 
        abstract protected function saveProductAttributes($id);

        // Method to retrieve all existing products from the database
        public function getProducts(){
            //USe COALESCE() function to return only the type-specific attribute with a value (not null)
            $sql = "SELECT p.*, COALESCE(concat ('Weight: ', b.weight, ' KG'), concat ('Size: ', d.size, ' MB'), 
                    concat ('Dimensions: ', f.height, 'x', f.width, 'x', f.length, ' CM')) AS attributes 
                    FROM products p LEFT JOIN book b ON p.id = b.id LEFT JOIN dvd d ON p.id = d.id 
                    LEFT JOIN furniture f ON p.id=f.id ORDER BY p.id";
            $stmt = $this->connectDB()->query($sql);
            $products = $stmt->fetchAll();
        
            return $products;
        }
        

        // Method to delete selected products from the database
        protected function deleteProduct($SKU){
            $sql = "DELETE FROM products WHERE sku= :sku";
            $delete=$this->connectDB()->prepare($sql);
            $delete->bindParam(':sku', $SKU);
            $delete->execute();
        }

        // Method to check if SKU already exists in the database
        public function skuExists($SKU){
            $sql = "SELECT COUNT(*) FROM products WHERE sku = :sku";
            $stmt = $this->connectDB()->prepare($sql);
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