<?php
require_once('Routes.php');
require_once('class/Database.php');

function __autoload($class_name){
        if (file_exists('./class/'.$class_name.'php')){
              require_once'./class/'.$class_name.'.php';
        } else if (file_exists('./controllers/'.$class_name.'.php')){
              require_once'./contollers/'.$class_name.'.php';
          }
  }
?>
<!Doctype html>
<html>
    <head>
        <title>Mon Site</title>
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>inc/css/style.css" />
    </head>
    <body>
        <header>
			<div class="conteneur">
				<span>
					<a href="" title="Mon Site">MonSite.com</a>
                </span>
				<nav>
					<?php
					if(internauteEstConnecteEtEstAdmin()) // admin
					{ // BackOffice
						echo '<a class="m_adm" href="' . RACINE_SITE . 'admin/gestion_membre.php">Gestion des membres</a>';
						echo '<a class="m_adm" href="' . RACINE_SITE . 'admin/gestion_commande.php">Gestion des commandes</a>';
						echo '<a class="m_adm" href="' . RACINE_SITE . 'admin/gestion_boutique.php">Gestion de la boutique</a><br />';
					}
					if(internauteEstConnecte()) // membre et admin
					{
            echo '<div class="status"><a href="#" style="cursor:none;">Compte : ' . $_SESSION['membre']['pseudo'] .'</a></div>';

						echo '<a class="m_mem" href="' . RACINE_SITE . 'profil.php">Voir votre profil</a>';
						echo '<a class="m_mem" href="' . RACINE_SITE . 'boutique.php?categorie=tshirt">Accès à la boutique</a>';
						echo '<a class="m_mem" href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
						echo '<a class="m_mem" href="' . RACINE_SITE . 'connexion.php?action=deconnexion">Se déconnecter</a>';
					}
					else // visiteur
					{
            echo '<div class="status visiteur"><a href="#" style="cursor:none;">Non-connecté</a></div>';

						echo '<a href="' . RACINE_SITE . 'inscription.php">Inscription</a>';
						echo '<a href="' . RACINE_SITE . 'connexion.php">Connexion</a>';
						echo '<a href="' . RACINE_SITE . 'boutique.php?categorie=tshirt">Accès à la boutique</a>';
						echo '<a class="panier_s" href="' . RACINE_SITE . 'panier.php">Voir votre panier</a>';
					}
					// visiteur=4 liens - membre=4 liens - admin=7 liens
					?>
				</nav>
			</div>
        </header>
        <section>     

			<div class="conteneur">
