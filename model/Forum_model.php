<?php 
include_once "config/bdd.php";
class Categorie_model
{
    protected $bdd = null;
    public $ID;
    public $nom_cat;
    public $ordre;
    public $permission;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->nom_cat = $arrayInfos[1];
        $this->ordre = $arrayInfos[2];
        $this->permission = $arrayInfos[3];
    }
}

class Forum_model
{
    protected $bdd = null;
    public $ID;
    public $nom_forum;
    public $id_categorie;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->nom_forum = $arrayInfos[1];
        $this->id_categorie = $arrayInfos[2];
    }
}

class Post_model
{
    protected $bdd = null;
    public $ID;
    public $titre_post;
    public $contenu_post;
    public $id_commentaire;
    public $autheur_post;
    public $id_forum;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->titre_poste = $arrayInfos[1];
        $this->contenu_post = $arrayInfos[2];
        $this->id_commentaire = $arrayInfos[3];
        $this->autheur_post = $arrayInfos[4];
        $this->id_forum = $arrayInfos[5];
    }
}

class Commentaire_model
{
    protected $bdd = null;
    public $ID;
    public $contenu_commentaire;
    public $autheur_commentaire;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->contenu_commentaire = $arrayInfos[1];
        $this->autheur_commentaire = $arrayInfos[2];
    }
}
