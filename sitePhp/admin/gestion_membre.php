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

if(isset($_GET['pseu']) && $_GET['pseu'] == "do")
	{
	if(isset($_POST['level'])) {
			$value = $_POST['level'];
			if(isset($_POST['level'])) {
				if($_POST['level'] == "1"){
			$membre_pseudo = $_GET['membre_pseudo'];
			Database::query("UPDATE membre SET statut=$value WHERE pseudo=?", array($membre_pseudo));
			header("Location:gestion_membre.php?pseu=do&&membre_pseudo=". $membre_pseudo ."&&valider=ok&&statut=1");
		}
		else {
			$membre_pseudo = $_GET['membre_pseudo'];
			Database::query("UPDATE membre SET statut=$value WHERE pseudo=?", array($membre_pseudo));
			header("Location:gestion_membre.php?pseu=do&&membre_pseudo=". $membre_pseudo ."&&valider=ok&&statut=0");
			}
		}
		}


		if(isset($_GET['valider']) && $_GET['valider'] == "ok")
			{
				if(isset($_GET['statut']) && $_GET['statut'] == "1")
				{
					$membre_pseudo = $_GET['membre_pseudo'];
					echo "<div class='validation'>Vous avez bien changé le status" . $membre_pseudo . " en élévation : 1</div>";
				}
				else {
					$membre_pseudo = $_GET['membre_pseudo'];
					echo "<div class='validation'>Vous avez bien changé le status" . $membre_pseudo . " en élévation : 0</div>";
				}
			}


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
	echo "<th>Modification statut</th>";

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

		echo  '<td>

		 <form id="elevation" name="elevation" onclick="return(confirm(\"Etes-vous sûr de vouloir modifier le statut de ce membre?\"));" method="post" action="gestion_membre.php?pseu=do&&membre_pseudo='. $membre['pseudo'] . '">
					<select name="level">
				<option name="level" value="1"> 1</option>
			<option name="level" value="0" selected>0</option>
		</select>
</form>
 </td>';

		echo '</tr>';
}

	echo '</table><input form="elevation" name="chg_admin" value="Confirmer" type="submit">';
