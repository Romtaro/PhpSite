<?php
/**
 * Class pannier hérite de l'interface pannier
 */
  require_once("inc/arbitre/controle_panier.php");
class Panier extends Unpanier {

  function __construct($titre, $quantite)
  {
  $this->set_titre($titre);
  $this->set_quantite($quantite);
  $this->id_produit = " ";
  }
function public ajout_panier(){

    	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_POST[id_produit]'");
    	$produit = $resultat->fetch_assoc();
    	ajouterProduitDansPanier($produit['titre'],$_POST['id_produit'],$_POST['quantite'],$produit['prix']);

  }
function public vider_panier(){

    	unset($_SESSION['panier']);
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
      controleachat():

    	}

  }
}




 ?>
