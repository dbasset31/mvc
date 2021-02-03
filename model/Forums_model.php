<?php
include_once "config/bdd.php";
include_once "model/Topics_model.php";
class Forums_model{

    private $id;
    public $nom;
    public $desc;
    private $bdd;
    function __construct($args)
    {
        $this->bdd = new BDD();
        $this->id = $args[0];
        $this->nom = $args[2];
        $this->desc = $args[3];
    }
    
    function ChargerTopics()
    {
        $sqlFor = "select * from forum_topic where forum_id = ".$this->id;
        $manager = $this->bdd->Request($sqlFor);
        $result = $manager->fetchAll();
        
        $topics=array();
    //  die(var_dump($result[0]));
        foreach($result as $for)
        {
            
            $topic = new Topics_model($for);
            array_push($topics,$topic);
        }
        return $topics;
    }


}