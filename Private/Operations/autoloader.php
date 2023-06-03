<?php
function autoload($class) {
    require '../Controllers/'.$class.'.php';
    // include '../Controllers/'.$class.'.php';
}

spl_autoload_register('autoload');