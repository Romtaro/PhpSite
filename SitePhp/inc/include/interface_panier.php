<?php
Interface public Unpanier{
private $titre;
$id_produit;
private $quantite;
abstract function public ajout_panier();
abstract function public vider_panier();
abstract function public Montant_total();
abstract function public set_titre($titre);
abstract function public set_quantite($quantite);
}



 ?>
