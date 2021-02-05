<?php
include_once "config/bdd.php";
class Posts_model{

    private $id_post;
    public $text_post;
    public $createur_post;
    public $date_poste;
    public $titre_post;
    public $topic_id;
    private $bdd;
    function __construct($args)
    {
        $this->bdd = new BDD();
        $this->id_post = $args[0];
        $this->titre_post = $args[2];
        $this->text_post = $args[3];
        $this->createur_post = $args[1];
        $this->date_poste = $args[4];
        $this->topic_id = $args[5];
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