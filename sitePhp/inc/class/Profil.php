<?php
class Profil{
  private $data;

  public function traitementProfil()
  {
  $this->data .= '<div class="cadre"><h2> Voici vos informations de profil </h2>';
  $this->data .= '<p> votre email est: ' . $_SESSION['membre']['email'] . '<br>';
  $this->data .= 'votre ville est: ' . $_SESSION['membre']['ville'] . '<br>';
  $this->data .= 'votre cp est: ' . $_SESSION['membre']['code_postal'] . '<br>';
  $this->data .= 'votre adresse est: ' . $_SESSION['membre']['adresse'] . '</p></div><br /><br />';
}

    public function showProfil(){
        echo $this->data;
    }

}
 ?>
