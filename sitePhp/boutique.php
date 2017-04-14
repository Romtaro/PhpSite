<?php
require_once('inc/haut.inc.php');
require_once("inc/class/Boutique.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//

$categories_des_produits = Database::query("SELECT DISTINCT categorie FROM produit");

//debug($categories_des_produits);
$boutique = new Boutique($categories_des_produits);

$boutique->traitementBoutique($categories_des_produits);

if(isset($_GET['categorie'])) {
    $boutique->traitementCategorie($categories_des_produits);
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//

$boutique->show();
require_once("inc/bas.inc.php");
