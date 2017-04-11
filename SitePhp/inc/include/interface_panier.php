<?php

Interface Unpanier {

abstract public function ajout_panier($titre,$id_produit,$quantite,$prix);
abstract function vider_panier();
//abstract function Montant_total();
//abstract function set_titre($titre);
//abstract function set_quantite($quantite);
abstract function payer();
}



 ?>
