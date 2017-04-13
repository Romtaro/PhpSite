<?php
require_once('../inc/class/Database.php');
require_once("../inc/init.inc.php");
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
require_once("../inc/haut.inc.php");
//require_once("../inc/menu.inc.php");
echo '<h1> Voici les membres inscrit au site </h1>';
	$resultat = Database::query("SELECT * FROM membre");
	echo "Nombre de membre(s) : " . count($resultat);
	echo "<table style='border-color:red' border=10> <tr>";
	foreach($resultat as $key => $colonne)
	//debug($colonne);
	{
		echo '<th>' . $colonne. '</th>';
	}
	echo '<th> Supprimer </th>';
	echo "</tr>";
	foreach($resultat as $key => $membre)
	{
		echo '<tr>';
		foreach ($membre as $key => $information)
		{
			echo '<td>' . $information . '</td>';
		}
		echo "<td><a href='gestion_membre.php?msg=supok&&id_membre=" . $membre['id_membre'] . "' onclick='return(confirm(\"Etes-vous s�r de vouloir supprimer ce membre?\"));'> X </a></td>";
		echo '</tr>';
	}
	echo '</table>';
