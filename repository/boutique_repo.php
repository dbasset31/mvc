<?php
include_once "config/bdd.php";
include_once "model/item_model.php";

class Boutique_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }
    public function GetAllItems()
    {
        $sql = "SELECT * FROM item_boutique";
        $result = $this->bdd->Request($sql);
        $donnes = $result->fetchALL();
        $items=array();
        foreach ($donnes as $ob)
        {
            array_push($items, new Item_model($ob));
        }
        
        return $items;
    }
}