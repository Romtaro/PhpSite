<?php
	require_once("inc/haut.inc.php");


	if($_POST)
	{
	    $membre = new Membre($_POST);
		if(!empty($_POST['mdp'])) {
	        $user = Database::query("update membre SET mdp='$_POST[mdp]', nom='$_POST[nom]', prenom='$_POST[prenom]', email='$_POST[email]', civilite='$_POST[sexe]', ville='$_POST[ville]', code_postal='$_POST[cp]', adresse='$_POST[adresse]' where id_membre='" . $_SESSION['membre']['id_membre'] . "'");
	        $membre = new Membre($user);
	        $membre->traiatementMembre($user);
	    }
	    else {
		    $membre->mdpvide();
		}




	if(isset($_GET['action']) && $_GET['action'] == 'modif')
	{
	    $membre->successModifMdp();
	}

}


?>		<div class="formulaire_obj"><div class="formulaire_form form_prod">

		<h2> Modification de vos informations </h2>
		<?php
		if(!isset($_SESSION['membre'])) {
			//echo "<script>alert(\"Vous n'êtes pas connecté pour faire ceci !\");</script>";
			header("location:connexion.php");
		} else {
			echo "vous êtes connecté sous le pseudo: " . $_SESSION['membre']['pseudo'];
		}
		?><br /><br />
		<form method="post" enctype="multipart/form-data" action="membres.php">
		<input type="hidden" id="id_membre" name="id_membre" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['id_membre']; ?>" />
			<label for="pseudo">Pseudo</label>
				<input disabled type="text" id="pseudo" name="pseudo" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['pseudo']; ?>"/><br />
				<input type="hidden" id="pseudo" name="pseudo" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['pseudo']; ?>"/>

			<label for="mdp">Nouv. Mot de passe</label>
				<input type="text" id="mdp" name="mdp" value="<?php if(isset($mdp)) print $mdp; ?>"/><br /><br />

			<label for="nom">Nom</label>
				<input type="text" id="nom" name="nom" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['nom']; ?>"/><br />

			<label for="prenom">Prénom</label>
				<input type="text" id="prenom" name="prenom" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['prenom']; ?>"/><br />

			<label for="email">Email</label>
				<input type="text" id="email" name="email" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['email']; ?>"/><br />
<div class="choix_civilite">
			<label for="sexe">Sexe</label>
					<select id="sexe" name="sexe">
						<option value="m" <?php if(isset($_SESSION['membre']['civilite']) && $_SESSION['membre']['civilite'] == "m") print "selected"; ?>>Homme</option>
						<option value="f" <?php if(isset($_SESSION['membre']['civilite']) && $_SESSION['membre']['civilite'] == "f") print "selected"; ?>>Femme</option>
					</select><br />
</div>
			<label for="ville">Ville</label>
				<input type="text" id="ville" name="ville" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['ville']; ?>"/><br />

		<label for="cp">Cp</label>
			<input type="text" id="cp" name="cp" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['code_postal']; ?>"/><br />

		<label for="adresse">Adresse</label>
					<textarea id="adresse" name="adresse"><?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['adresse']; ?></textarea>
					<input type="hidden" name="statut" value="<?php if(isset($_SESSION['membre'])) print $_SESSION['membre']['statut']; ?>"/><br />
			<br /><br />
			<input type="submit" class="submit" name="modification" value="modification"/>
	</form><br />
</div>
