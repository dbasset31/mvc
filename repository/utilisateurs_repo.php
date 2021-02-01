<?php
include_once "config/bdd.php";
include_once "model/Utilisateur_model.php";
include_once "model/settings_model.php";

class Utilisateur_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }
    function login($identifiant,$pass) 
    {
        $identifiant = $identifiant;
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
        $pass = $this->bdd->secure($pass);
        $pass_conf = $this->bdd->secure($pass_conf);
        $nom = $this->bdd->secure($nom);
        $prenom = $this->bdd->secure($prenom);
        $naissance = $this->bdd->secure($naissance);
        $email = $this->bdd->secure($email);
        $pseudo = $this->bdd->secure($pseudo);
        $sexe = $this->bdd->secure($sexe);
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
                $result = $db->Request($sqlInsert,array($identifiant, $pass_hache, $email, $pseudo, $sexe, 0, $nom, $prenom, $naissance, date("d M Y H:i:s"), '/uploads/avatars/unnamed.jpg', 1));
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

    function GetById($args)
    {
        $sql = "SELECT * FROM users WHERE id=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();

        return new utilisateur_model($donnees[0]);
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
        else 
        {
            return "#pseudo_exist";
        }
    }

    function modif_avatar($avatar)
    {
        $db = $this->bdd;
        $sqlSelect = "SELECT * FROM users WHERE avatar=?";
        $result = $this->bdd->Request($sqlSelect, array($avatar));
        if ($_SESSION['Connected']->SetAvatar("/".$avatar))
                return "#avatar_modif_ok";
            else
                return "#avatar_modif_fail";
    
    }

    function modif_user($id, $user, $email, $pseudo, $sexe, $adm, $nom, $prenom, $naissance, $inscription, $avatar) 
    {     
       // var_dump($id, $user, $email, $pseudo, $sexe, $admin, $nom, $prenom, $naissance, $inscription, $avatar);
        
        $db = $this->bdd;
        $sqlSelect = "SELECT * FROM users WHERE id= ?";
        $result = $this->bdd->Request($sqlSelect, array($id));
        $check_user = $result->fetchALL();
        $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;","<script>","</script>","&lt;script&gt;","&lt;/script&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]");
        $users = str_replace($tabSearch, $tabRepl, $check_user[0]);
        if ($result->rowCount() > 0)
        {
           var_dump($check_user[0]);
            $userModel = new Utilisateur_model($users);
            $userModel->SetUser($user, $email, $pseudo, $sexe, $adm, $nom, $prenom, $naissance, $inscription, $avatar);
            return array("#user_modif_ok",$userModel);
        }
        else
            return array("#user_crit_fail",$userModel);
    }

    function delete($id){
        $db = $this->bdd;
        $sqlDelete = "DELETE FROM users WHERE id=$id";
        $result = $this->bdd->Request($sqlDelete);
        if($result->rowCount() > 0)
        return "#user_delete_succes";
            return ("#user_delete_fail");
    }
    function CheckCode($idd,$idp,$data,$code1,$code2=null,$code3=null,$code4=null,$code5=null)
    {
        $idpp = $idp;
        $iddd = $idd;
        // Déclaration des variables
        $ident=$idp=$ids=$idd=$codes=$code1=$code2=$code3=$code4=$code5=$datas='';
        $idp = $idpp;
        // $ids n'est plus utilisé, mais il faut conserver la variable pour une question de compatibilité
        $idd = $iddd;
        $ident=$idp.";".$ids.";".$idd;
        // On récupère le(s) code(s) sous la forme 'xxxxxxxx;xxxxxxxx'
        if(isset($_POST['code1'])) $code1 = $_POST['code1'];
        if(isset($_POST['code2'])) $code2 = ";".$_POST['code2'];
        if(isset($_POST['code3'])) $code3 = ";".$_POST['code3'];
        if(isset($_POST['code4'])) $code4 = ";".$_POST['code4'];
        if(isset($_POST['code5'])) $code5 = ";".$_POST['code5'];
        $codes=$code1.$code2.$code3.$code4.$code5;
        // On récupère le champ DATAS
        if(isset($_POST['DATAS'])) $datas = $_POST['DATAS'];
        // On encode les trois chaines en URL
        $ident=urlencode($ident);
        $codes=urlencode($codes);
        $datas=urlencode($datas);

        /* Envoi de la requête vers le serveur StarPass
        Dans la variable tab[0] on récupère la réponse du serveur
        Dans la variable tab[1] on récupère l'URL d'accès ou d'erreur suivant la réponse du serveur */
        $get_f=@file( "https://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas" );
        if(!$get_f)
        {
        exit( "Votre serveur n'a pas accès au serveur de StarPass, merci de contacter votre hébergeur. " );
        }
        $tab = explode("|",$get_f[0]);

        if(!$tab[1]) $url = "https://script.starpass.fr/error.php";
        else $url = $tab[1];

        // dans $pays on a le pays de l'offre. exemple "fr"
        $pays = $tab[2];
        // dans $palier on a le palier de l'offre. exemple "Plus A"
        $palier = urldecode($tab[3]);
        // dans $id_palier on a l'identifiant de l'offre
        $id_palier = urldecode($tab[4]);
        // dans $type on a le type de l'offre. exemple "sms", "audiotel, "cb", etc.
        $type = urldecode($tab[5]);
        // vous pouvez à tout moment consulter la liste des paliers à l'adresse : https://script.starpass.fr/palier.php

        // Si $tab[0] ne répond pas "OUI" l'accès est refusé
        // On redirige sur l'URL d'erreur
        if( substr($tab[0],0,3) != "OUI" )
        {
            return array($codes,"#code_fail");
            exit;
        }
        else
        {
            /* Le serveur a répondu "OUI"

            On place un cookie appelé CODE_BON et qui vaut la valeur 1
            Ce cookie est valide jusqu'à ce que l'internaute ferme son navigateur
            Dans les pages suivantes, nous testerons l'existence du cookie
            S'il existe, c'est que l'internaute est autorisé,
            sinon on le renverra sur une page d'erreur */
            return array("#code_ok",$code1);
            // Si vous  avez plusieurs documents, nommer le cookie plutôt 'code'+iDocumentId

            // vous pouvez afficher les variables de cette façon :
            // echo "idd : $idd / codes : $codes / datas : $datas / pays : $pays /palier : $palier / id_palier : $id_palier / type : $type";
        }
    }
    
    function UpdateSolde($tab)
    {
        $idUser = $tab;
        $user = $this->GetById($idUser);
        $OldSolde = $user->solde;
        $SelectNbPoint = "SELECT * from settings";
        $result = $this->bdd->Request($SelectNbPoint);
        $nbPoint = $result->fetchALL();
        if ($result->rowCount() > 0)
        {
            $settings = new Settings_model($nbPoint[0]);
            $newSolde = $OldSolde + $settings->nb_point;
            $UpdatePoint = "UPDATE users SET solde=? WHERE id=?";
            $result = $this->bdd->Request($UpdatePoint,array($newSolde,$idUser));
            $user->solde = $newSolde;
            $_SESSION['Connected']->solde = $user->solde;
            return array($user->solde,"#update_solde_ok");
        }
        else
        return "#update_solde_fail";
        
    }
}

?>