<?php
require_once("inc/haut.inc.php");



if(isset($_GET['id_produit'])) 	{

    $produits = new Produits($_POST);

    $resultat = Database::query("SELECT * FROM produit WHERE id_produit =?",array($_GET['id_produit']));
}

$produits->traitementProduit($resultat);

if(count($resultat) <= 0) {
    header("location:boutique.php");
    exit();
   }

$produits->show();
require_once("inc/bas.inc.php");
