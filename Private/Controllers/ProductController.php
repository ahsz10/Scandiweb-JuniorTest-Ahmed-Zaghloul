<?php
include 'Product.php'; //working
// include 'DVD.php';
// include 'Book.php';
// include 'Furniture.php';
// include '../Operations/autoloader.php';
    class ProductController extends Product{

        public function __construct( ) { 
            // echo"ahmed is here";
        }

        // Method to add a new product to the database
        public function addProduct ($SKU, $name, $price, $type, $attributes){
            // Check if the SKU already exists in database
            echo "in add product controller";
            if (!$this->skuExists($SKU)) {
                // echo "product already exists";
                // Initialization the product type class and sending the parameters in the constructor
                $className = $type;
                $newProduct = new $className($SKU, $name, $price, $type, $attributes);
                // Saving the new product in products table and taking its id to save it in the product type table 
                $index = $newProduct->saveProduct();
                $newProduct->saveProductAttributes($index);
                return true;
            } else{
                return false;
            }
        }

        // Method to delete the selected products
        public function deleteProducts($SKU){
            //Using method from Product class
            $this->deleteProduct($SKU);
        }

        // Method to display all products in the database
        public function displayAllProducts(){
            echo "in diplay all products <br>";
            //Using method from Product class
            $products = $this->getProducts();
            return $products;
        }

        // Empty abstract method 
        protected function saveProductAttributes($id){}
    }
?>