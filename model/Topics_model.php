<?php
include_once "config/bdd.php";
include_once "model/Posts_model.php";
class Topics_model{

    private $id;
    public $titre_topic;
    public $contenu;
    public $createur;
    public $vue;
    public $time;
    private $bdd;
    function __construct($args)
    {
        $this->bdd = new BDD();
        $this->id = $args[0];
        $this->titre_topic = $args[2];
        $this->contenu = $args[3];
        $this->createur = $args[4];
        $this->vue = $args[5];
        $this->time = $args[6];
    }

    function ChargerPosts()
    {
        $sqlPost = "select * from forum_post where topic_id = ".$this->id;
        $manager = $this->bdd->Request($sqlPost);
        $result = $manager->fetchAll();
        
        $posts=array();
    //  die(var_dump($result[0]));
        foreach($result as $po)
        {
            
            $post = new Posts_model($po);
            array_push($posts,$post);
        }
        return $posts;
    }
    // 
}