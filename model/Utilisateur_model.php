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
        $this->solde = $arrayInfos[14];
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

    function SetNaissance($new_naissance) 
    {
        $naissanceNew = $this->bdd->secure($new_naissance);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE users SET naissance= ? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($naissanceNew, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->naissance = $naissanceNew;
                return true;
            }
            return false;
    }
    function SetEmail($new_email) 
    {
        $emailNew = $this->bdd->secure($new_email);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE users SET email= ? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($emailNew, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->email = $emailNew;
                return true;
            }
            return false;
    }

    function SetProfil($new_pseudo, $new_naissance, $new_email) 
    {
        $this->SetPseudo($new_pseudo);
        $this->SetNaissance($new_naissance);
        $this->SetEmail($new_email);
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

    function SetUser($identifiant, $email, $pseudo, $sexe, $nom, $prenom, $naissance) 
    {
        $userIdentifiant = $this->bdd->secure($identifiant);
        $userEmail = $this->bdd->secure($email);
        $userPseudo = $this->bdd->secure($pseudo);
        $userSexe = $this->bdd->secure($sexe);        
        $userNom = $this->bdd->secure($nom);
        $userPrenom = $this->bdd->secure($prenom);
        $userNaissance = $this->bdd->secure($naissance);
        $date = date_create($userNaissance);
        $userNaissance = date_format($date, "Y-m-d");
            $db = $this->bdd;
            $sqlUpdate = "UPDATE users SET identifiant=? , email=? , pseudo=? , sexe=? , nom=? , prenom=? , naissance=? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($userIdentifiant,$userEmail,$userPseudo,$userSexe,$userNom,$userPrenom,$userNaissance, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->identifiant = $userIdentifiant;
                $this->email = $userEmail;
                $this->nom = $userNom;
                $this->prenom = $userPrenom;
                $this->sexe = $userSexe;
                $this->pseudo = $userPseudo;
                $this->naissance = $userNaissance;
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