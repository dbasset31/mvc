<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/admin_repo.php";
include_once "model/Utilisateur_model.php";
include_once "repository/news_repo.php";
include_once "model/News_model.php";
include_once "repository/utilisateurs_repo.php";
include_once "repository/page_repo.php";
include_once "model/Pages_model.php";
class Page_controller extends controller
{
    private $admin_repo=null;
    function __construct()
    {
        $this->admin_repo = new Admin_repo();
        $this->news_repo = new News_repo();
        $this->utilisateur_repo = new Utilisateur_repo();
        $this->page_repo= new Pages_repo();
    }

    function vue($args)
    {
        if(empty($args))
            header('location: /error/perdu');
        $page_model = $this->page_repo->GetByUrl($args);
        
        return $this->view($page_model);
    }
}