<?php
include_once "config/bdd.php";
include_once "model/News_model.php";

class Pages_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    function GetByUrl($args)
    {
        $sql = "SELECT * FROM pages WHERE url=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();
        if($result->rowCount() > 0)
            return new Pages_model($donnees[0]);
        return null;
    }

    function GetById($args)
    {
        $sql = "SELECT * FROM pages WHERE id=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();
        if($result->rowCount() > 0)
            return new Pages_model($donnees[0]);
        return null;
    }

    function delete($id){
        $db = $this->bdd;
        $sqlDelete = "DELETE FROM pages WHERE id=$id";
        $result = $this->bdd->Request($sqlDelete);
        if($result->rowCount() > 0)
        return "#page_delete_succes";
            return ("#page_delete_fail");
    }
}