<?php

class Autoloader{

    static function register(){
      spl_autoload_register(array('Autoloader','autoload'));
    }
    static function autoload($class){

      require_once"$class.php";
    

    }
}
?>
