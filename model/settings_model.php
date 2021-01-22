<?php 
include_once "config/bdd.php";
class Settings_model
{
    protected $bdd = null;
    public $titre;
    public $logo;
    public $couleur_text;
    public $couleur_lien;
    public $couleur_h1;
    public $couleur_h2;
    public $couleur_h3;
    public $couleur_h4;
    public $couleur_input;
    public $nbNews;
    public $label;


    function __construct($arrayInfos)
    {
       
        $this->bdd = new BDD();
        $this->titre = $arrayInfos[0];
        $this->logo = $arrayInfos[1];
        $this->couleur_text = $arrayInfos[2];
        $this->couleur_lien = $arrayInfos[3];
        $this->couleur_h1 = $arrayInfos[4];
        $this->couleur_h2 = $arrayInfos[5];
        $this->couleur_h3 = $arrayInfos[6];
        $this->couleur_h4 = $arrayInfos[7];
        $this->couleur_input = $arrayInfos[8];
        $this->nbNews = $arrayInfos[9];
        $this->label = $arrayInfos[10];
    }
    
}


?>