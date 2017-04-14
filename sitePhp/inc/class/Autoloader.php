<?php

class Autoloader{
  static function autoload($class){


    require_once"$class.php";

  //  require_once"$class.php";
/*
   $url= $_SERVER['PHP_SELF'];
   $values=explode("/",$url);
   $length=sizeof($values);
   $lastString= $values[$length-1];
>>>>>>> 4cb0c27407410a911f614074421c2016f38c58e7

    if ( $lastString == "profil.php" || $lastString == "boutique.php" || $lastString == "fiche_produit.php" || $lastString == "connexion.php" )
      {
          require_once"/inc/class/$class.php";
      }

    if ($lastString == "gestion_commande.php" || $lastString == "gestion_membre.php" || $lastString == "gestion_boutique.php" )
      {
          require_once"$class.php";
      }
  }
*/}
  static function register()
  {
      spl_autoload_register(array('Autoloader','autoload'));
    }

}
?>
