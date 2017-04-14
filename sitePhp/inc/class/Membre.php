<?php

class Membre
{
    private $data;


    public function traiatementMembre($res)
    {
        unset($_SESSION['membre']);
        foreach ($res as $indice => $element) {
            if ($indice != 'mdp') {
                $_SESSION['membre'][$indice] = $element;
            } else {
                $_SESSION['membre'][$indice] = $_POST['mdp'];
            }
        }
        header("Location:membres.php?action=modif");
    }


    public function mdpvide()
    {
        $this->data = "le nouveau mot de passe doit être renseigné !";
        echo $this->data;
    }

    public function successModifMdp() {
        $this->data = "la modification à bien été prise en compte";
        echo $this->data;
    }

    public function isPseudoValid($pseudo) {

        $tryPseudo = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo );
        if($tryPseudo = "" || strlen($tryPseudo) < 1 || strlen($tryPseudo) > 20) {
            return false;
        }
        return true;
    }

    public function showUser(){
        $this->data .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caracteres. <br> Caractere accepte : Lettre de A a Z et chiffre de 0 a 9</div>";
    }


    public function ficheUser(){
        $this->data .= '<div class="cadre"><h2> Voici vos informations de profil </h2>';
        $this->data .= '<p> votre email est: ' . $this->email . '<br>';
        $this->data .= 'votre ville est: ' . $this->ville . '<br>';
        $this->data .= 'votre cp est: ' . $this->code_postal . '<br>';
        $this->data .= 'votre adresse est: ' . $this->adresse . '</p></div><br /><br />';
    }

    public function show(){
        echo $this->data;

        echo '<a href="' . RACINE_SITE . 'membres.php" OnClick="return(confirm(\'Vous allez basculer sur la modification du profil, continuez ?\'));"><img src="'. RACINE_SITE .'inc/img/edit.png" /></a>';
}

}
