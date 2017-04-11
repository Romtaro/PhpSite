<?php
Interface public panier{
$titre;
$id_produit;
$quantite;
abstract function public ajout_panier();
abstract function public vider_panier();
abstract public Montant_total();

}



 ?>
