<?php 
include_once "config/bdd.php";
class Utilisateur_model
{
    protected $bdd = null;
    public $ID;
    public $identifiant;
    public $nom;
    public $pseudo;
    public $prenom;
    public $sexe;
    public $email;
    public $inscription;
    public $naissance;
    public $admin;
    public $avatar;

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->identifiant = $arrayInfos[1];
        $this->email = $arrayInfos[3];
        $this->nom = $arrayInfos[7];
        $this->prenom = $arrayInfos[8];
        $this->sexe = $arrayInfos[5];
        $this->pseudo = $arrayInfos[4];
        $this->naissance = $arrayInfos[9];
        $this->inscription = $arrayInfos[10];
        $this->admin = $arrayInfos[6] == 1 ? true : false;
        $this->avatar = $arrayInfos[11];
    }
    
    function SetPseudo($new_pseudo) 
    {
        $pseudoNew = $this->bdd->secure($new_pseudo);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE users SET pseudo= ? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($pseudoNew, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->pseudo = $pseudoNew;
                return true;
            }
            return false;
    }
    function info()
    {
        return $this->prenom." ".$this->nom;
    }
}


?>