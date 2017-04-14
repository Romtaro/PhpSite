<?php

/**
 * Created by PhpStorm.
 * User: Max
 * Date: 14/04/2017
 * Time: 15:07
 */
class Boutique
{
    private $data;

    public function traitementBoutique($res)
    {
        $this->data = '<div class="formulaire_obj"><h1>Boutique</h1>';
        $this->data .= '<div class="boutique-gauche">';
        $this->data .= "<ul>";

        foreach ($res as $key => $cat) {

            // 	debug($key);

            $this->data .= "<li><a href='?categorie=" . $cat['categorie'] . "'>" . $cat['categorie'] . "</a></li><hr>";
        }
        $this->data .= "</ul>";
        $this->data .= "</div>";

    }


//--- AFFICHAGE DES PRODUITS ---//

       public function traitementCategorie() {

        $this->data .= '<div class="boutique-droite">';
        if(isset($_GET['categorie']))
        {
            $donnees = Database::query("SELECT id_produit,reference,titre,photo,prix FROM produit WHERE categorie=?", array($_GET['categorie']));
            foreach($donnees as $key2 =>$produit)
            {
                $this->data .= '<div class="boutique-produit">';
                $this->data .= "<h3>$produit[titre]</h3>";
                $this->data .= "<a href=\"fiche_produit.php?id_produit=$produit[id_produit]\"><img src=\"$produit[photo]\" width=\"130\" height=\"100\" /></a>";
                $this->data .= "<p>$produit[prix] €</p>";
                $this->data .= '<a href="fiche_produit.php?id_produit=' . $produit['id_produit'] . '">Voir la fiche</a>';
                $this->data .= '</div>';
            }
        }
           $this->data .= '</div></div>';
    }

    public function show(){
        echo $this->data;
    }




}
