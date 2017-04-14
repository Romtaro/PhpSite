<?php
Class Panier{
    static function newPanier(){
    if (!isset($_SESSION['panier']))
  {
     $_SESSION['panier']=array();
     $_SESSION['panier']['titre'] = array();
     $_SESSION['panier']['id_produit'] = array();
     $_SESSION['panier']['quantite'] = array();
     $_SESSION['panier']['prix'] = array();
  }

  }



   function ajouter($titre,$id_produit,$quantite,$prix)
  {
    Panier::newPanier();
      $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
      if ($position_produit !== false)
      {
           $_SESSION['panier']['quantite'][$position_produit] += $quantite ;
      }
      else
      {
          $_SESSION['panier']['titre'][] = $titre;
          $_SESSION['panier']['id_produit'][] = $id_produit;
          $_SESSION['panier']['quantite'][] = $quantite;
  		$_SESSION['panier']['prix'][] = $prix;
      }
  }






    static function vider(){

    unset($_SESSION['panier']);
}





    static function payer(){
      for($i=0 ;$i < count($_SESSION['panier']['id_produit']) ; $i++)
      {
        $resultat = Database::query("SELECT * FROM produit WHERE id_produit=" . $_SESSION['panier']['id_produit'][$i]);
    foreach( $resultat as $key => $produit){
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
            Panier::retirerPanier($_SESSION['panier']['id_produit'][$i]);
            $i--;
          }
          $erreur = true;
        }
      }}
    }




    static function retirerPanier($id_produit_a_supprimer)
    {
    	$position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
    	if ($position_produit !== false)
        {
    		array_splice($_SESSION['panier']['titre'], $position_produit, 1);
    		array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
    		array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
    		array_splice($_SESSION['panier']['prix'], $position_produit, 1);
    	}
    }

    static function montantTotal()
    {
       $total=0;
       for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
       {
          $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
       }
       return round($total,2);
    }
}

 ?>
