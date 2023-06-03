<?php

include 'autoloader.php';
// require '../Controllers/ProductController.php';

// Check if mass delete button pressed and there are checked products (at least one check box checked)
if (isset($_POST["delete"]) && isset($_POST["checked"])) {
    // User input
    $productsToDelete = $_POST["checked"];

    //Initialization the product controller to delete product(s)
    $delete = new ProductController();
    foreach ($productsToDelete as $SKU) {
        $delete->deleteProducts($SKU);
    }
    
   //Redirect to product-list page
   header('../../index.php');
   exit();
} else {
    header('../../index.php');
}
?>