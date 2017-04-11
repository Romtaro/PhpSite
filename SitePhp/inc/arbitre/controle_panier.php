<?php

function controleachat(){
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

 ?>
