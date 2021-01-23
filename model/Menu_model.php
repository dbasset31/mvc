<?php 
include_once "config/bdd.php";
class Menu_model
{
    protected $bdd = null;
    public $ID;
    public $nom;
    public $lien;
    public $permission;
    public $ordre;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->nom = $arrayInfos[1];
        $this->lien = $arrayInfos[2];
        $this->permission = $arrayInfos[3];
        $this->ordre = $arrayInfos[4];

    }

    
    
}