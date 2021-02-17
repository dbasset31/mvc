<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/news_repo.php";
include_once "model/News_model.php";

class News_controller extends Controller{
    private $news_repo =null;
    function __construct(){
        $this->news_repo = new News_repo();
    }
    function index($args=null) {
        $result = $this->news_repo->index($args);
        return $this->view($result);
    }

    
}
