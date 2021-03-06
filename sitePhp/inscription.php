<?php
require_once("inc/init.inc.php");
require_once("inc/class/Database.php");
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
			Database::query("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
			$contenu .= "<div class='validation'>Vous etes inscrit a notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
		}
	}
}
?>
<?php require_once("inc/haut.inc.php"); ?>
<?php echo $contenu; ?>
<div class="formulaire_obj">
	<div class="formulaire_form">
		<h3>Inscription</h3>
		<form method="post" action="">
			<div class="pseutomail">
	    <label for="pseudo">Pseudo</label>
	    <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="Votre pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>

	    <label for="mdp">Mot de passe</label>
	    <input type="password" id="mdp" name="mdp" required="required" placeholder=""><br><br>

	    <label for="nom">Nom</label>
	    <input type="text" id="nom" name="nom" placeholder="Votre nom"><br><br>

	    <label for="prenom">Prénom</label>
	    <input type="text" id="prenom" name="prenom" placeholder="Votre prénom"><br><br>

	    <label for="email">Email</label>
	    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
		</div>
			<div class="choix_civilite">
	    <label for="civilite">Civilité</label>
	    <input name="civilite" value="m" checked="" type="radio">Homme<br /><br />
			<input name="civilite" value="f" type="radio">Femme<br /><br />
		</div><div class="viltoadr">
	    <label for="ville">Ville</label>
	    <input type="text" id="ville" name="ville" placeholder="Votre ville" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."><br><br>

	    <label for="cp">Code Postal</label>
	    <input type="text" id="code_postal" name="code_postal" placeholder="Code postal" pattern="[0-9]{5}" title="5 chiffres requis : 0-9"><br><br>

	    <label for="adresse">Adresse</label>
	    <textarea id="adresse" name="adresse" placeholder="Votre dresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés :  a-zA-Z0-9-_."></textarea><br><br>

		    <input name="inscription" value="S'inscrire" type="submit">
			</div>
		</form>
	</div>
</div>
<?php require_once("inc/bas.inc.php"); ?>
