<?php
require_once("../inc/init.inc.php");
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
//-------------------------------------------------- Affichage ---------------------------------------------------------//
require_once("../inc/haut.inc.php");
//require_once("../inc/menu.inc.php");
	echo '<h1> Voici les commandes passées sur le site </h1>';
	echo '<table border="1"><tr>';

	$information_sur_les_commandes = Database::query("SELECT c.*, m.pseudo, m.adresse, m.ville, m.code_postal FROM commande c LEFT JOIN membre m ON  m.id_membre = c.id_membre");
	//debug($information_sur_les_commandes);
	echo "Nombre de commande(s) : " . count($information_sur_les_commandes);
	//debug($information_sur_les_commandes);
	echo "<table style='border-color:red' border=10> <tr>";

	$information_sur_les_commandes = Database::queryp("SELECT c.*, m.pseudo, m.adresse, m.ville, m.code_postal FROM commande c LEFT JOIN membre m ON  m.id_membre = c.id_membre");


	foreach( $information_sur_les_commandes as $key => $colonne)
	{
		echo '<th>' . $key. '</th>';

	}
	echo "</tr>";

	$information_sur_les_commandes = Database::query("SELECT c.*, m.pseudo, m.adresse, m.ville, m.code_postal FROM commande c LEFT JOIN membre m ON  m.id_membre = c.id_membre");

	$chiffre_affaire = 0;
	foreach( $information_sur_les_commandes as $key => $commande)
	{
		$chiffre_affaire += $commande['montant'];
		echo '<div>';
		echo '<tr>';
		echo '<td><a href="gestion_commande.php?suivi=' . $commande['id_commande'] . '">Voir la commande ' . $commande['id_commande'] . '</a></td>';
		echo '<td>' . $commande['id_membre'] . '</td>';
		echo '<td>' . $commande['montant'] . '</td>';
		echo '<td>' . $commande['date_enregistrement'] . '</td>';
		echo '<td>' . $commande['etat'] . '</td>';
		echo '<td>' . $commande['pseudo'] . '</td>';
		echo '<td>' . $commande['adresse'] . '</td>';
		echo '<td>' . $commande['ville'] . '</td>';
		echo '<td>' . $commande['code_postal'] . '</td>';
		echo '</tr>	';
		echo '</div>';
	}
	echo '</table><br />';
	echo 'Calcul du montant total des revenus:  <br />';
		print "le chiffre d'affaires de la societe est de : $chiffre_affaire €";

	echo '<br />';
	if(isset($_GET['suivi']))
	{
		echo '<h1> Voici le détails pour une commande</h1>';
		echo '<table border="1">';
		echo '<tr>';
		$information_sur_une_commande = Database::query("SELECT * FROM details_commande WHERE id_commande=$_GET[suivi]");

		$nbcol = count($information_sur_une_commande);
		echo "<table style='border-color:red' border=10> <tr>";
		for ($i=0; $i < $nbcol; $i++)
		{
			$colonne = $information_sur_une_commande->fetch_field();
			echo '<th>' . $colonne . '</th>';
		}
		echo "</tr>";

		foreach( $information_sur_une_commande as $key => $details_commande)
		{
			echo '<tr>';
				echo '<td>' . $details_commande['id_details_commande'] . '</td>';
				echo '<td>' . $details_commande['id_commande'] . '</td>';
				echo '<td>' . $details_commande['id_produit'] . '</td>';
				echo '<td>' . $details_commande['quantite'] . '</td>';
				echo '<td>' . $details_commande['prix'] . '</td>';
			echo '</tr>';
		}
		echo '</table>';
	}
