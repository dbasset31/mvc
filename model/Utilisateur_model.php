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
    public $solde;

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
        $this->solde = $arrayInfos[13];
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

    function SetAvatar($new_avatar)
    {
        $avatar_new = $new_avatar;
        $db = $this->bdd;
        $sqlUpdate = "UPDATE users SET avatar=? WHERE id= ?";
        if($this->avatar != "/uploads/avatars/unnamed.jpg")
        {
        $av = substr($this->avatar, 1);
        unlink($av);
        }
        $result = $db->Request($sqlUpdate, array($avatar_new, $this->ID));
        $check_update = $result->rowCount();
        if ($check_update > 0)
        {
            $this->avatar = $avatar_new;
            return true;
        }
        return false;
    }

    function SetUser($identifiant, $email, $pseudo, $sexe, $adm, $nom, $prenom, $naissance, $inscription, $avatar) 
    {
      
        //var_dump($identifiant);
        $userIdentifiant = $this->bdd->secure($identifiant);
        $userEmail = $this->bdd->secure($email);
        $userPseudo = $this->bdd->secure($pseudo);
        $userSexe = $this->bdd->secure($sexe);        
        $userNom = $this->bdd->secure($nom);
        $userPrenom = $this->bdd->secure($prenom);
        $userNaissance = $naissance;
        $userInscription = $inscription;
        $userAdmin = $adm;
        $userAvatar = $avatar;
            $db = $this->bdd;
            $sqlUpdate = "UPDATE users SET identifiant=? , email=? , pseudo=? , sexe=? , admin=? , nom=? , prenom=? , naissance=? , date_inscription=? , avatar=? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($userIdentifiant,$userEmail,$userPseudo,$userSexe,$adm,$userNom,$userPrenom,$userNaissance,$userInscription,$userAvatar, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->identifiant = $userIdentifiant;
                $this->email = $userEmail;
                $this->nom = $userNom;
                $this->prenom = $userPrenom;
                $this->admin = $adm;
                $this->sexe = $userSexe;
                $this->pseudo = $userPseudo;
                $this->naissance = $userNaissance;
                $this->inscription = $userInscription;
                $this->admin = $userAdmin;
                $this->avatar = $userAvatar;
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