<?php
include_once "repository/forum_repo.php";
class Forum_controller extends Controller{
    private $forum_repo=null;
    function __construct(){
        // $this->admin_repo = new Admin_repo();
        // $this->news_repo = new News_repo();
        // $this->utilisateur_repo = new Utilisateur_repo();
        // $this->settings_repo = new Settings_repo();
         $this->forum_repo = new Forum_repo();
        // $this->CheckAdmin();
    }

    function index() {
        
        $categorie = $this->forum_repo->GetCategorie();
        $nb = $categorie[1];
        // var_dump($categorie[0][0]['nom_categorie']);
        // die();
        $categories = array();
        $forum = array();
        
        
        
        return $this->view($categorie,$forum);
    }
}