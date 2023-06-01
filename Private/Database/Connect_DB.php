<?php
    require_once '../Controllers/Product.php';
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=scandiweb_test','root','');
        Product::set_database($pdo);
    }catch(PDOException $e  ){
        echo $e->getMessage();
    }
    // echo'connection success';
?>