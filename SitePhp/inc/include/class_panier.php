<?php
/**
 * Class pannier hérite de l'interface pannier
 */
class Pannier extends Unpanier
{

  function __construct($titre, $quantite)
  {
  $this->set_titre($titre);
  $this->set_quantite($quantite);
  $this->id_produit = " ";
  }
  abstract function public ajout_panier(){
    if(isset($_POST['ajout_panier']))
    {	// debug($_POST);
    	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
    	$produit = $resultat->fetch_assoc();
    	ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);
    }
  }
function public vider_panier(){
    if(isset($_GET['action']) && $_GET['action'] == "vider")
    {
    	unset($_SESSION['panier']);
    }
  }
function public Montant_total(){

  }
 function public set_titre($titre){
this-->$titre= "La boutique";
return echo($tire);
  }
  function public set_quantite($quantite){

  }

  function public payer(){
    if(isset($_POST['payer']))
    {
    	for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++)
    	{
    		$resultat = executeRequete("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
    		$produit = $resultat->fetch_assoc();
    		if($produit['stock'] < $_SESSION['panier']['quantite'][$i])
    		{
    			$contenu .= '<hr /><div class="erreur">Stock Restant: ' . $produit['stock'] . '</div>';
    			$contenu .= '<div class="erreur">Quantité demandée: ' . $_SESSION['panier']['quantite'][$i] . '</div>';
    			if($produit['stock'] > 0)
    			{
    				$contenu .= '<div class="erreur">la quantité de l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été réduite car notre stock était insuffisant, veuillez vérifier vos achats.</div>';
    				$_SESSION['panier']['quantite'][$i] = $produit['stock'];
    			}
    			else
    			{
    				$contenu .= '<div class="erreur">l\'produit ' . $_SESSION['panier']['id_produit'][$i] . ' à été retiré de votre panier car nous sommes en rupture de stock, veuillez vérifier vos achats.</div>';
    				retirerproduitDuPanier($_SESSION['panier']['id_produit'][$i]);
    				$i--;
    			}
    			$erreur = true;
    		}
    	}
    	if(!isset($erreur))
    	{
    		executeRequete("INSERT INTO commande (id_membre, montant, date_enregistrement) VALUES (" . $_SESSION['membre']['id_membre'] . "," . montantTotal() . ", NOW())");
    		$id_commande = $mysqli->insert_id;
    		for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
    		{
    			executeRequete("INSERT INTO details_commande (id_commande, id_produit, quantite, prix) VALUES ($id_commande, " . $_SESSION['panier']['id_produit'][$i] . "," . $_SESSION['panier']['quantite'][$i] . "," . $_SESSION['panier']['prix'][$i] . ")");
    		}
    		unset($_SESSION['panier']);
    		mail($_SESSION['membre']['email'], "confirmation de la commande", "Merci votre n° de suivi est le $id_commande", "From:vendeur@dp_site.com");
    		$contenu .= "<div class='validation'>Merci pour votre commande. votre n° de suivi est le $id_commande</div>";
    	}
    }

  }
}




 ?>
