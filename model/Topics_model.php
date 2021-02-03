<?php
include_once "config/bdd.php";
class Topics_model{

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

    
    // 
}