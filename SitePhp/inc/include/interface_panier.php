<?php
Interface Unpanier{
abstract function ajout_panier();
abstract function vider_panier();
abstract function Montant_total();
abstract function set_titre($titre);
abstract function set_quantite($quantite);
abstract function payer();
}



 ?>
