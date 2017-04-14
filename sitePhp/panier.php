<?php
include("inc/haut.inc.php");
require_once("inc/class/Panier.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- AJOUT PANIER ---//
if(isset($_POST['ajout_panier']))
{	// debug($_POST);
	$resultat = Database::query("SELECT * FROM produit WHERE id_produit=?",array($_POST['id_produit']));
	foreach( $resultat as $key => $produit){
	Panier::ajouter($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
		}
}
//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
	Panier::vider();
}
//--- PAIEMENT ---//
if(isset($_POST['payer']))
{
Panier::payer();
	if(!isset($erreur))
	{
		Database::query("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . Panier::montantTotal() . ", NOW())");

		$commandenbr = Database::queryp("SELECT * FROM commande ORDER BY id_commande DESC");
		$commandenbr = $commandenbr['id_commande'];
		$id_prod = $_SESSION['panier']['id_produit'];
		for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
		{
			//debug($id_prod);
		 Database::query("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($commandenbr, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
		 $stock_base = Database::queryq("SELECT * FROM produit WHERE id_produit=?", $id_prod);
		 //debug($stock_base);
		 $stock_base = $stock_base[0];
		 //debug($stock_base);
		 foreach ($stock_base as $key => $value) {
			 //debug($key);
				 	if($key == 'stock') {
						$id_prod = $_SESSION['panier']['id_produit'][0];
						$v = $_SESSION['panier']['quantite'][0];
						//debug($v);
						$value -= $v;
						//debug($value);
						Database::query("UPDATE produit SET stock=$value WHERE id_produit=?", array($id_prod));
			 			}
			 }
		}
		unset($_SESSION['panier']);
		mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $commandenbr", "From:vendeur@dp_site.com");
		$contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $commandenbr</div>";
	}
}

//--------------------------------- AFFICHAGE HTML ---------------------------------//

echo $contenu;
echo "<table border='1' style='border-collapse: collapse' cellpadding='7'>";
echo "<tr><td colspan='5'>Panier</td></tr>";
echo "<tr><th>Titre</th><th>Produit</th><th>Quantité</th><th>Prix Unitaire</th><th>Action</th></tr>";
if(empty($_SESSION['panier']['id_produit'])) // panier vide
{
	echo "<tr><td colspan='5'>Votre panier est vide</td></tr>";
}
else
{
	for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
	{
		echo "<tr>";
		echo "<td>" . $_SESSION['panier']['titre'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['id_produit'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['quantite'][$i] . "</td>";
		echo "<td>" . $_SESSION['panier']['prix'][$i] . "</td>";
		echo "</tr>";
	}
	echo "<tr><th colspan='3'>Total</th><td colspan='2'>" . Panier::montantTotal() . " euros</td></tr>";
	if(internauteEstConnecte())
	{
		echo '<form method="post" action="">';
		echo '<tr><td colspan="5"><input type="submit" name="payer" value="Valider et déclarer le paiement" /></td></tr>';
		echo '</form>';
	}
	else
	{
		echo '<tr><td colspan="3">Veuillez vous <a href="inscription.php">inscrire</a> ou vous <a href="connexion.php">connecter</a> afin de pouvoir payer</td></tr>';
	}
	echo "<tr><td colspan='5'><a href='?action=vider'>Vider mon panier</a></td></tr>";
}
echo "</table><br />";
echo "<i>Règlement par CHAQUE uniquement à l'adresse suivante : Ynov Aix - Bureau Couscous-Vodka</i><br />";
include("inc/bas.inc.php");
