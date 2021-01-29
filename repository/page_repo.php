<?php
include_once "config/bdd.php";
include_once "model/Pages_model.php";

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
    function modif($id, $titre, $contenu, $url, $connect, $admin) 
    {     
          $db = $this->bdd;
          $sqlSelect = "SELECT * FROM pages WHERE id= ?";
          $result = $this->bdd->Request($sqlSelect, array($id));
          $check_page = $result->fetchALL();
            if ($result->rowCount() > 0)
            {
                $page = new Pages_model($check_page[0]);
                $page->SetNew($titre, $contenu, $url, $admin, $connect);
                return array("#page_modif_ok",$page);
            }
            else
                return array("#page_crit_fail",$page);
          }
}