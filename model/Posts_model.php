<?php
include_once "config/bdd.php";
class Posts_model{

    private $id;
    public $titre;
    public $contenu;
    public $createur;
    public $vue;
    public $time;
    private $bdd;
    function __construct($args)
    {
        $this->bdd = new BDD();
        $this->id = $args[0];
        $this->titre = $args[2];
        $this->contenu = $args[3];
        $this->createur = $args[4];
        $this->vue = $args[5];
        $this->time = $args[6];
    }

    function ChargerPosts()
     {
    //     $sqlFor = "select * from forum_post where topic_id = ".$this->id;
    //     $manager = $this->bdd->Request($sqlFor);
    //     $result = $manager->fetchAll();

    // // die(var_dump($result));
    //     foreach($result as $for)
    //     {
    //         $forum = new Forums_model($for);
    //         array_push($this->forums,$forum);
    //     }
    //     return $forum;
     }
}