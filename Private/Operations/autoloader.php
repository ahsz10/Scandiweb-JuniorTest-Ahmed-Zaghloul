<?php

function autoload($class) {
    require '../Controllers/'.$class.'.php';
    // echo '<br> <br> <br>Autoloading '.$class;
}

spl_autoload_register('autoload');
$getProducts = new ProductController();