<?php 
include_once "config/bdd.php";
class Pages_model
{
    protected $bdd = null;
    public $ID;
    public $titre;
    public $contenu;
    public $url;
    public $admin;
    public $connected;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->titre = $arrayInfos[1];
        $this->contenu = htmlspecialchars_decode($arrayInfos[2]);
        $this->url = $arrayInfos[3];
        $this->admin = $arrayInfos[4];
        $this->connected = $arrayInfos[5];
    }
    
}
