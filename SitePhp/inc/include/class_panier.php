<?php
/**
 * Class pannier hérite de l'interface pannier
 */

require_once("inc/init.inc.php");
require_once("interface_panier.php");

class Panier implements Unpanier {

  function __construct()
  {
    if (!isset($_SESSION['panier']))
    {
       $_SESSION['panier']=array();
       $_SESSION['panier']['titre'] = array();
       $_SESSION['panier']['id_produit'] = array();
       $_SESSION['panier']['quantite'] = array();
       $_SESSION['panier']['prix'] = array();
    }
  }

    public function ajout_panier($titre,$id_produit,$quantite,$prix){
  	$panier= new Panier;
      $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
      if ($position_produit !== false)
      {
           $_SESSION['panier']['quantite'][$position_produit] += $quantite ;
      }
      else
      {
          $_SESSION['panier']['titre'][] = $titre;
          $_SESSION['panier']['id_produit'][] = $id_produit;
          $_SESSION['panier']['quantite'][] = $quantite;
  		$_SESSION['panier']['prix'][] = $prix;
      }
  }
}




 ?>
