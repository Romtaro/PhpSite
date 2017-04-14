<?php
require_once("../inc/haut.inc.php");
if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
if(isset($_GET['msg']) && $_GET['msg'] == "supok")
{
	Database::query("delete from membre where id_membre=$_GET[id_membre]");
	header("Location:gestion_membre.php");
}
//-------------------------------------------------- Affichage ---------------------------------------------------------//
	echo '<div class="formulaire_obj"><div class="gestion_panel">';
//require_once("../inc/menu.inc.php");
echo '<h1> Voici les membres inscrit au site </h1>';
	$resultats = Database::queryq("SELECT * FROM membre");
	echo "Nombre de membre(s) : " . count($resultats);
	echo "<table class='tab2' border=2> <tr>";
		$resultat = Database::queryp("SELECT * FROM membre");
	foreach($resultat as $key => $colonne)
	//debug($colonne);
	{
		echo '<th>' . $key. '</th>';
	}
	echo '<th> Supprimer </th>';
	echo "<th><a href='gestion_admin.php' 'onclick='return(confirm(\"Ajouter un compte Admin ?\"));'>Ajouter Admin</th>";

	echo "</tr>";
	foreach($resultats as $key => $membre)
	{
	  //debug($membre);
		echo '<tr>';
		foreach ($membre as $key => $information)
		{

		//	debug($information);
			echo '<td>' . $information . '</td>';
		}
		echo "<td><a href='gestion_membre.php?msg=supok&&id_membre=" . $membre['id_membre'] . "' onclick='return(confirm(\"Etes-vous sûr de vouloir supprimer ce membre?\"));'> X </a></td>";
		echo "<td><a href='gestion_membre.php" . $membre['id_membre'] . "' onclick='return(confirm(\"Etes-vous sûr de vouloir supprimer ce membre?\"));'> V </a></td>";

		echo '</tr>';
}

	echo '</table>';
