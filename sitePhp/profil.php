<?php
require_once("inc/haut.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(!internauteEstConnecte())
{
	header("location:connexion.php");
}
//$contenu .= '<p class="centre">Bonjour <strong>' . $_SESSION['membre']['pseudo'] . '</strong></p>'; // exercice: tenter d'afficher le pseudo de l'internaute pour lui dire Bonjour.
$profil = new Profil();

$profil->traitementProfil();

//--------------------------------- AFFICHAGE HTML ---------------------------------//

$profil->showProfil();
echo '<a href="' . RACINE_SITE . 'membres.php" OnClick="return(confirm(\'Vous allez basculer sur la modification du profil, continuez ?\'));"><img src="'. RACINE_SITE .'inc/img/edit.png" /></a>';

require_once("inc/bas.inc.php");
