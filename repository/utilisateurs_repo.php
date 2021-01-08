<?php
include_once "config/bdd.php";
include_once "model/Utilisateur_model.php";

class Utilisateur_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }
    function login($identifiant,$pass) 
    {
        $identifiant = $this->bdd->secure($identifiant);
        $sql = "SELECT * FROM users WHERE identifiant= ?";
        $result = $this->bdd->Request($sql, array($identifiant));
        $check_user = $result->fetchALL();
        if (count($check_user) != 0)
        {
            $verify = password_verify($pass,$check_user[0]['mdp']); 
            if ($verify)
            {
                $user = new Utilisateur_model($check_user[0]);
                $_SESSION['Connected']=$user;
                $sqlUpdate = "UPDATE users SET connected= 1 WHERE id= ? ";
                $result = $this->bdd->Request($sqlUpdate,array($user->ID));
                return $user;
            }
            else 
            {
                    return "#login_pwdFail";
            }
        }
        else {
            return "#login_userNotEx";
        }
    }

    function register($identifiant,$pass,$pass_conf,$nom,$prenom,$naissance, $email,$pseudo, $sexe) 
    {
        $identifiant = $this->bdd->secure($identifiant);
        $sqlSelect = "SELECT * FROM users WHERE identifiant= ?";
        $result = $this->bdd->Request($sqlSelect, array($identifiant));
        $check_user = $result->fetchALL();
        if (count($check_user) == 0)
        {
            if ($pass == $pass_conf)
            {
                $db = $this->bdd;
                $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
                $sqlInsert = "INSERT INTO users (identifiant, mdp, email, pseudo, sexe, admin, nom, prenom, naissance, date_inscription, avatar, connected) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $result = $db->Request($sqlInsert,array($identifiant, $pass_hache, $email, $pseudo, $sexe, 0, $nom, $prenom, $naissance, date("d M Y H:i:s"), '/uploads/avatars/avatar.jpg', 1));
                $check_insert = $result->rowCount();
                if ($check_insert != 1)
                {
                    return "#register_userNonInserted";
                }
                return "#register_success";
            }
            return "#register_passwordDoesntMatch";
        }
        return "#register_userExist";
    } 

      function modif($pseudo) 
      {
            $db = $this->bdd;
            $sqlSelect = "SELECT * FROM users WHERE pseudo= ?";
            $result = $this->bdd->Request($sqlSelect, array($pseudo));
            $check_pseudo = $result->fetchALL();
            if (count($check_pseudo) == 0)
            {
                if ($_SESSION['Connected']->SetPseudo($pseudo))
                    return "#pseudo_modif_ok";
                else
                    return "#pseudo_crit_fail";
            }
            else {
                return "#pseudo_exist";
            }
        }


    //         $sqlUpdate = "UPDATE users SET pseudo= ? WHERE identifiant= ?";
    //         $result = $db->Request($sqlUpdate,array($pseudoNew, $id));
    //         $check_insert = $result->rowCount();
    //         die($check_insert);
    // }
}