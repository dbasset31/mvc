<?php
// include_once "repository/forum_repo.php";
include_once "config/bdd.php";
include_once "model/Categorie_model.php";
include_once "model/Forums_model.php";
include_once "model/Topics_model.php";
class Forum_controller extends Controller{
    protected $bdd;
    public $forum_model;
    function __construct(){
        $this->bdd = new BDD();
        //  $this->forum_model = new Forums_model();
        // $this->categorie = new Categorie_model();
    }

    function index($args=null) {

        if($args == null){
            $sqlCat = "select * from forum_categorie";
            $manager = $this->bdd->Request($sqlCat);
            $result = $manager->fetchAll();
            $tabCategories = array();
            foreach($result as $cat)
            {
                $categorie = new Categorie_model($cat);
                array_push($tabCategories,$categorie);
            }
            return $this->view($tabCategories);
        }
        $args=str_replace("-"," ",$args);
        $args=ucfirst($args);
        $select = "SELECT * from forum_forum WHERE forum_name = ?";
         $manager = $this->bdd->Request($select,array($args));
         $result = $manager->fetchAll();
        var_dump($result[0]);
        // // die();
         $forum = new Forums_model($result[0]);
         var_dump($forum->ChargerTopics());
         return $this->view($forum->ChargerTopics());
        // var_dump($forum);
        // die();
        //  $topics = $this->forum_model->ChargerTopics($result);

        // $topics = new Forums_model($args);
        // return $this->view($topics);
    }
}