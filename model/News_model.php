<?php 
include_once "config/bdd.php";
class News_model
{
    protected $bdd = null;
    public $ID;
    public $titre;
    public $contenu;
    public $date;


    function __construct($arrayInfos)
    {
       
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->titre = $arrayInfos[1];
        $this->contenu = $arrayInfos[2];
        $this->date = $arrayInfos[3];
    }

    function SetNew($new_titre, $new_contenu) 
    {
        $nouvelleTitre = $this->bdd->secure($new_titre);
        $nouvelleContenu = $this->bdd->secure($new_contenu);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE news SET titre= ? , contenu=? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($nouvelleTitre,$nouvelleContenu, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->titre = $nouvelleTitre;
                $this->contenu = $nouvelleContenu;
                return true;
            }
            return false;
    }

}



?>