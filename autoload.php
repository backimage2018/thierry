<?php 

function autoloader($classe)
{
    require $classe . '.class.php';
}

spl_autoload_register('autoloader');

?>