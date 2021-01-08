<?php
include_once "config/bdd.php";
include_once "model/News_model.php";

class News_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    function index()
    {
        $sql = "SELECT * FROM news ORDER BY id DESC";
        $result = $this->bdd->Request($sql);
        $donnes = $result->fetchALL();
        $objects = array();
        foreach ($donnes as $ob)
        {
            array_push($objects, new News_model($ob));
        }
        return $objects;
    }
    function GetById($args)
    {
        $sql = "SELECT * FROM news WHERE id=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();
        return new News_model($donnees[0]);
    }

    function modif($id, $titre, $contenu) 
    {     
          $db = $this->bdd;
          $sqlSelect = "SELECT * FROM news WHERE id= ?";
          $result = $this->bdd->Request($sqlSelect, array($id));
          $check_nouvelle = $result->fetchALL();
            if ($result->rowCount() > 0)
            {
                $new = new News_model($check_nouvelle[0]);
                $new->SetNew($titre, $contenu);
                return array("#new_modif_ok",$new);
            }
            else
                return array("#new_crit_fail",$new);
          }
}
