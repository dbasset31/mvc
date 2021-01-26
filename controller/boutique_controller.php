<?php
include_once "model/item_model.php";
include_once "repository/boutique_repo.php";
class Boutique_controller extends controller{
     private $boutique_repo=null;
    function __construct(){
        // $this->admin_repo = new Admin_repo();
        // $this->news_repo = new News_repo();
        // $this->utilisateur_repo = new Utilisateur_repo();
         $this->boutique_repo = new Boutique_repo();

         $this->CheckConnect();
    }

    function index() {
        $items = $this->boutique_repo->GetAllItems();
        var_dump($items);
        return $this->view($items);
    }
}