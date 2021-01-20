<?php
include_once "config/bdd.php";
include_once "model/Utilisateur_model.php";
include_once "model/News_model.php";

class Admin_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    function utilisateurs() 
    {
        $sql = "SELECT * FROM users";
        $result = $this->bdd->Request($sql,null);
        $donnes = $result->fetchALL();
        $objects = array();
        foreach ($donnes as $ob)
        {
            array_push($objects, new Utilisateur_model($ob));
        }
        return $objects;
    }

    function liste_news() 
    {
        $sql = "SELECT * FROM news";
        $result = $this->bdd->Request($sql,null);
        $donnes = $result->fetchALL();
        $objects = array();
        foreach ($donnes as $ob)
        {
            array_push($objects, new News_model($ob));
        }
        return $objects;
    }

    function add_new($titre,$contenu) 
    {
        $titre = $this->bdd->secure($titre);
        $db = $this->bdd;
        $contenu = htmlspecialchars($contenu);   
        // var_dump($contenu);
        // die();    
        $sqlInsert = "INSERT INTO news (titre, contenu, date) VALUES (?,?,?)";
        $result = $db->Request($sqlInsert,array($titre, $contenu, date("d/m/Y")));
        $check_insert = $result->rowCount();
        if ($check_insert != 1)
        {
            return "#news_NonInserted";
        }
        else
        {
            return "#add_new_success";
        }
    }
   
}