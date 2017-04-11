<?php
/**
 * Class pannier hérite de l'interface pannier
 */
class Pannier extends Unpanier
{

  function __construct($titre, $quantite)
  {
  $this->set_titre($titre);
  $this->set_quantite($quantite);
  $this->id_produit = " ";
  }
  abstract function public ajout_panier(){

  }
  abstract function public vider_panier(){

  }
  abstract function public Montant_total(){

  }
  abstract function public set_titre($titre){

  }
  abstract function public set_quantite($quantite){

  }
}




 ?>
