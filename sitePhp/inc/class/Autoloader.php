<?php

class Autoloader{
  static function autoload($class){

    require_once"$class.php";



  }
    static function register(){
      spl_autoload_register(array('Autoloader','autoload'));
    }



}
?>
