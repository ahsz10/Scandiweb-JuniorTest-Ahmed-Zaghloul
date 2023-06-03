<?php
include 'Product.php'; 
    class ProductController extends Product{

        public function __construct( ) {}

        // Method to add a new product to the database
        public function addProduct ($SKU, $name, $price, $type, $attributes){
            // Check if the SKU already exists in database
            if (!$this->skuExists($SKU)) {
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
            //Using method from Product class
            $products = $this->getProducts();
            return $products;
        }

        // Empty abstract method 
        protected function saveProductAttributes($id){}
    }
?>