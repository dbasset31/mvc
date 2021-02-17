<?php
include_once "config/bdd.php";
include_once "model/settings_model.php";

class Settings_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    
    function GetAllSettings()
    {
        $sql = "SELECT * FROM settings";
        $result = $this->bdd->Request($sql);
        $donnees = $result->fetch();

        if($result->rowCount() > 0)
            return new Settings_model($donnees);
        return null;
    }
    function modif($nbNews) 
    {     
          $db = $this->bdd;
          $sqlUpdate = "UPDATE settings SET nbNews=?";
          $result = $this->bdd->Request($sqlUpdate,array($nbNews));
          }
    function modifColor($h1,$h2,$h3,$h4,$text,$lien,$label,$header_color,$footer_color) 
    {     
          $db = $this->bdd;
          $sqlUpdate = "UPDATE settings SET couleur_h1=?,couleur_h2=?,couleur_h3=?,couleur_h4=?,couleur_text=?,couleur_lien=?,couleur_label=?,header_color=?,footer_color=?";
          $result = $this->bdd->Request($sqlUpdate,array($h1,$h2,$h3,$h4,$text,$lien,$label,$header_color, $footer_color));
          }
    }
