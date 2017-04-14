<?php
require_once("inc/init.inc.php");
//require_once('inc/class/Database.php');
require_once('inc/class/Autoloader.php');
Autoloader::register();
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
	session_destroy();
}
if(internauteEstConnecte())
{
	header("location:profil.php");
}
if($_POST)
{
    $membre = Database::query("SELECT * FROM membre WHERE pseudo=?",array($_POST['pseudo']));
    debug($membre);
    if(count($membre) > 0 )
    {
        $membre = $membre[0];
        if($membre['mdp'] == $_POST['mdp'])
        {
            foreach($membre as $indice => $element)
            {
                if($indice != 'mdp')
                {
                    $_SESSION['membre'][$indice] = $element;
                }
            }
            header("location:profil.php");
        }
        else
        {
            $contenu .= '<div class="erreur">Erreur de MDP</div>';
        }
    }
    else
    {
        $contenu .= '<div class="erreur">Erreur de pseudo</div>';
    }
}
//--------------------------------- AFFICHAGE HTML ---------------------------------//
?>
<?php require_once("inc/haut.inc.php"); ?>
<?php echo $contenu; ?>
<div class="formulaire_obj">
	<div class="formulaire_form">
<form method="post" action="">
	<h3>Connexion : </h3>
	<div class="login">
    <label for="pseudo">Pseudo</label><br />
    <input type="text" id="pseudo" name="pseudo" /><br /> <br />

    <label for="mdp">Mot de passe</label><br />
    <input type="text" id="mdp" name="mdp" /><br /><br />

     <input type="submit" value="Se connecter"/>
	 </div>
</form>
</div>
<?php require_once("inc/bas.inc.php"); ?>
