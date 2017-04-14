<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14/04/2017
 * Time: 14:22
 */
class Produits
{
    private $data;

    public function traitementProduit($res)
    {

        foreach ($res as $key => $produit) {
//$produit = $resultat->fetch_assoc();
            $this->data = "<div class='boutique'><div class='fiche'>";
            $this->data .= "<h3>Titre : $produit[titre]</h3><hr /><br />";
            $this->data .= "<p>Categorie: $produit[categorie]</p>";
            $this->data .= "<p>Couleur: $produit[couleur]</p>";
            $this->data .= "<p>Taille: $produit[taille]</p>";
            $this->data .= "<img src='$produit[photo]' width='150' height='150' />";
            $this->data .= "<p>Prix : $produit[prix] €</p><br />";
            $this->data .= "<p><i>Description: $produit[description]</i></p><br />";
        }
        if ($produit['stock'] > 0) {
            $this->data .= "<i>Nombre d'produit(s) disponible : $produit[stock] </i><br /><br />";
            $this->data .= '<form method="post" action="panier.php">';
            $this->data .= "<input type='hidden' name='id_produit' value='$produit[id_produit]' />";
            $this->data .= '<label for="quantite">Quantité : </label>';
            $this->data .= '<select id="quantite" name="quantite">';
            for ($i = 1; $i <= $produit['stock'] && $i <= 5; $i++) {
                $this->data .= "<option>$i</option>";
            }
            $this->data .= '</select>';
            $this->data .= '<input type="submit" name="ajout_panier" value="ajout au panier" />';
            $this->data .= '</form>';
        } else {
            $this->data .= 'Rupture de stock !';
        }
        $this->data .= "<br /><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a></div>";

    }


    public function show()
    {
        echo $this->data;
    }
}
