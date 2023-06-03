<?php
echo ' in autoload<br />';
function autoload($class) {
    // require '../Controllers/'.$class.'.php';
    include '../Controllers/'.$class.'.php';
    // echo '<br> <br> <br>Autoloading '.$class;
}

spl_autoload_register('autoload');
// $getProducts = new ProductController();