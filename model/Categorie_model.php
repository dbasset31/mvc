<?php
include_once "config/bdd.php";
include_once "model/Forums_model.php";
class Categorie_model{

    private $id;
    public $nom;
    public $bdd;
    public $forums;
    function __construct($args)
    {
        $this->bdd = new BDD();
        $this->id = $args[0];
        $this->nom = $args[1];
        $this->forums = array();
        $this->ChargerForums();
    }

    function ChargerForums()
    {
        $sqlFor = "select * from forum_forum where forum_cat_id = ".$this->id;
        $manager = $this->bdd->Request($sqlFor);
        $result = $manager->fetchAll();

    // die(var_dump($result));
        foreach($result as $for)
        {
            $forum = new Forums_model($for);
            array_push($this->forums,$forum);
        }
    }
}