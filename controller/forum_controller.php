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
    function index($args=null){
            header('location:/forum/forums');
    }
    function forums($args=null) {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        if(empty($url[3])){
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
        if(isset($url[3])){
            $args=str_replace("-"," ",$args);
            $args=ucfirst($args);
            $topic = explode('/', $_SERVER['REQUEST_URI']);
            $topic= str_replace("-"," ",$topic);
            $forum_name = $topic[3];
            $select = "SELECT * from forum_forum WHERE forum_name = ?";
            $manager = $this->bdd->Request($select,array($forum_name));
            $result = $manager->fetchAll();
            $forum = new Forums_model($result[0]);
            $chargeTopics= $forum->ChargerTopics();
            if(!empty($topic[4])){
                $topic_name = str_replace("-"," ",$topic[4]);
                    $sql = "SELECT * from forum_topic WHERE topic_titre=?";
                    $manager = $this->bdd->Request($sql,array($topic_name));
                    $result = $manager->fetchALL();
                    $top = new Topics_model($result[0]);
                    return $this->view(array($top->ChargerPosts(),$forum_name,$topic_name));
            }
            return $this->view(array($forum->ChargerTopics(),$forum_name));
            
        }

        // var_dump($forum);
        // die();
        //  $topics = $this->forum_model->ChargerTopics($result);

        // $topics = new Forums_model($args);
        // return $this->view($topics);
    }
}