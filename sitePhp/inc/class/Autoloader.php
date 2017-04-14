<?php

class Autoloader{
  static function autoload($class){
if($class =! ""){
    require_once"$class.php";
  }else {
    require_once "inc/$class.php";
  }


  }
    static function register(){
      spl_autoload_register(array('Autoloader','autoload'));
    }



}
?>
