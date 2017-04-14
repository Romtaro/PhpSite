<?php
require_once("../inc/haut.inc.php");
if($_POST)
{
	$verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']);
	if(!$verif_caractere || strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20 )
	{
		$contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caracteres. <br> Caractere accepte : Lettre de A a Z et chiffre de 0 a 9</div>";
	}

	if(empty($contenu))
	{

		$membre = Database::query("SELECT * FROM membre WHERE pseudo=?", array($_POST['pseudo']));


		if(count($membre) > 0)
		{
			$contenu .= "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre svp.</div>";
		}
		else
		{
			foreach($_POST as $indice => $valeur)
			{
				$_POST[$indice] = htmlEntities(addSlashes($valeur));
			}

			Database::query("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]', '$_POST[statut]')");
			$contenu .= "<div class='validation'>Vous etes inscrit a notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
		}
	}
}


?>

<?php echo $contenu; ?>
<div class="formulaire_obj">
	<div class="formulaire_form">
		<h3>Inscription Admin</h3>
		<form method="post" action="">
			<div class="pseutomail">
<h4>Voulez-vous passer ce membre en tant qu'administrateur</h4><br /><br />
            <label for="elevation" id="elevation">Elevation</label>
          <select>
        <option name="elev" value="1"> OUI</option>
      <option name="elev" value="0">NON</option>
    </select>

		</div>
			    <input name="chg_admin" value="Confirmer" type="submit">
			</div>
		</form>
	</div>
</div>
<?php require_once("../inc/bas.inc.php"); ?>
