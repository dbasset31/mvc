<?php 
include_once "config/bdd.php";
class Item_model
{
    protected $bdd = null;
    public $ID;
    public $id_item;
    public $nom;
    public $prix;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->id_item = $arrayInfos[1];
        $this->nom = $arrayInfos[2];
        $this->prix = $arrayInfos[3];
    }
}