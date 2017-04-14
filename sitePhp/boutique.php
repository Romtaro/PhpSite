<?php
require_once("inc/init.inc.php");
require_once('inc/class/Autoloader.php');
Autoloader::register();
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AFFICHAGE DES CATEGORIES ---//
$categories_des_produits = Database::query("SELECT DISTINCT categorie FROM produit");

//debug($categories_des_produits);
$contenu .= '<div class="boutique"><div class="boutique-gauche">';
$contenu .= "<ul>";

foreach( $categories_des_produits as $key => $cat){

	// 	debug($key);

	$contenu .= "<li><a href='?categorie="	. $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li><hr>";
}
$contenu .= "</ul>";
$contenu .= "</div>";
//--- AFFICHAGE DES PRODUITS ---//
$contenu .= '<div class="boutique-droite">';
if(isset($_GET['categorie']))
{
	$donnees = Database::query("SELECT id_produit,reference,titre,photo,prix FROM produit WHERE categorie=?", array($_GET['categorie']));
	foreach($donnees as $key2 =>$produit)
	{
		$contenu .= '<div class="boutique-produit">';
		$contenu .= "<h3>$produit[titre]</h3>";
		$contenu .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" width=\"130\" height=\"100\" /></a>";
		$contenu .= "<p>$produit[prix] €</p>";
		$contenu .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
		$contenu .= '</div>';
	}
}
$contenu .= '</div>';
//--------------------------------- AFFICHAGE HTML ---------------------------------//
require_once("inc/haut.inc.php");
echo $contenu;
require_once("inc/bas.inc.php");
