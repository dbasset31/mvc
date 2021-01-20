<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/admin_repo.php";
include_once "model/Utilisateur_model.php";
include_once "repository/news_repo.php";
include_once "model/News_model.php";
include_once "repository/utilisateurs_repo.php";
class Page_controller extends controller
{
    private $admin_repo=null;
    function __construct()
    {
        $this->admin_repo = new Admin_repo();
        $this->news_repo = new News_repo();
        $this->utilisateur_repo = new Utilisateur_repo();
    }

    function page($args)
    {
        return $this->view($args);
    }
}
      