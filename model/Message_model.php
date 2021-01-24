<?php 
include_once "config/bdd.php";
class Message_model
{
    protected $bdd = null;
    public $ID;
    public $autheur;
    public $message;
    public $date;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->autheur = $arrayInfos[1];
        $this->message = $arrayInfos[2];
        $this->date = $arrayInfos[3];
    }
}