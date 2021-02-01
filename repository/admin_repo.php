<?php
include_once "config/bdd.php";
include_once "model/Utilisateur_model.php";
include_once "model/News_model.php";
include_once "model/Pages_model.php";

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
        
        $db = $this->bdd;
        $titre = $this->bdd->secure($titre);
        $contenu = $this->bdd->secure($contenu);   
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

    function create_page($titre,$contenu,$url,$admin,$connect) 
    {
        $titre = $titre;
        $db = $this->bdd;
        $titre = $this->bdd->secure($titre);
        $contenu = $this->bdd->secure($contenu);
        $url = $this->bdd->secure($url);
        $admin = $this->bdd->secure($admin);
        $connect = $this->bdd->secure($connect);
        $sqlInsert = "INSERT INTO pages (titre, contenu, url, admin, connected) VALUES (?,?,?,?,?)";
        $result = $this->bdd->Request($sqlInsert,array($titre, $contenu, $url, $admin, $connect));
        $check_insert = $result->rowCount();
                
        if ($check_insert != 1)
        {
            return "#page_NonInserted";
        }
        else
        {
            return "#create_page_success";
        }
    }
    function liste_page() 
    {
        $sql = "SELECT * FROM pages";
        $result = $this->bdd->Request($sql,null);
        $donnes = $result->fetchALL();
        $objects = array();
        foreach ($donnes as $ob)
        {
            array_push($objects, new Pages_model($ob));
        }
        return $objects;
    }
}