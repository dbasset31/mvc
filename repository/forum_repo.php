<?php
include_once "config/bdd.php";
include_once "model/Forum_model.php";

class Forum_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    function GetCategorieID()
    {
        $sqlSelect = "SELECT * FROM forum_categorie";
        $result = $this->bdd->Request($sqlSelect);
        $donnes = $result->fetchALL();
        $nbCateg = count($donnes);
        return array($donnes, $nbCateg);
    }

    function GetCategorie()
    {
        $sqlSelect = "SELECT * FROM forum_categorie";
        $result = $this->bdd->Request($sqlSelect);
        $donnes = $result->fetchALL();
        $nbCateg = count($donnes);
        return array($donnes, $nbCateg);
    }


    function GetForumByCategorieId($id)
    {   
        $sqlSelect = "SELECT * FROM forum_forums WHERE id_categorie='$id'";
        $result = $this->bdd->Request($sqlSelect);
        $donnes = $result->fetchALL();
        $nbForum= count($donnes);
        return $donnes;
    }

    function GetForumByCategory($cat)
    {
        $sqlSelect = "SELECT * FROM forum_forums WHERE id_categorie=?";
    }

}