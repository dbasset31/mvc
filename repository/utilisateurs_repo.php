<?php
include_once "config/bdd.php";
include_once "model/Utilisateur_model.php";
include_once "model/settings_model.php";
include_once "model/Mails_model.php";

class Utilisateur_repo
{
    protected $bdd = null;
    protected $controller;
    function __construct()
    {
        $this->bdd = new BDD();
        $this->controller = new Controller();
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

    function register($identifiant,$pass,$pass_conf,$nom,$prenom,$naissance, $email,$pseudo, $sexe,$token,$ip_user) 
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
            $SelectSql = "SELECT email FROM users WHERE email=?";
            $result = $this->bdd->Request($SelectSql, array($email));
            $check_mail = $result->fetchALL();
            if(count($check_mail) == 0)
            {
                $sqlSelectp = "SELECT * FROM users_pending WHERE identifiant= ?";
                $resultp = $this->bdd->Request($sqlSelectp, array($identifiant));
                $check_userp = $resultp->fetchALL();
                if (count($check_userp) == 0)
                {
                    if ($pass == $pass_conf)
                    {
                        $db = $this->bdd;
                        $pass_hache = password_hash($pass, PASSWORD_DEFAULT);
                        $sqlInsert = "INSERT INTO users_pending (identifiant, mdp, email, pseudo, sexe, admin, nom, prenom, naissance, date_inscription,token,last_ip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                        $result = $db->Request($sqlInsert,array($identifiant, $pass_hache, $email, $pseudo, $sexe, 0, $nom, $prenom, $naissance, date("d M Y H:i:s"),$token,$ip_user));
                        $check_insert = $result->rowCount();
                        if ($check_insert != 1)
                        {
                            return "#register_userNonInserted";
                        }
                        return array("#register_success",$email,$identifiant,$pass,$token,$nom,$prenom);
                    }
                    return "#register_passwordDoesntMatch";
                }
                return "#register_userExist";
            }
            return "#register_emailExist"; 
        }
        return "#register_userExist";
    } 
    function activate($token) {
        $sqlSelect = "SELECT * FROM users_pending WHERE token=?";
        $result = $this->bdd->Request($sqlSelect,array($token));
        $check_user = $result->fetch();
        if(isset($check_user['token']))
        {
            if($check_user['token']== $token)
            {
                $sqlInsert = "INSERT INTO users (id,identifiant, mdp, email, pseudo, sexe, nom, prenom, naissance, date_inscription,avatar,last_ip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
                $result = $this->bdd->Request($sqlInsert,array($check_user['id'],$check_user['identifiant'], $check_user['mdp'], $check_user['email'], $check_user['pseudo'], $check_user['sexe'], $check_user['nom'], $check_user['prenom'], $check_user['naissance'], $check_user['date_inscription'],"/uploads/avatars/unnamed.jpg",$check_user['last_ip']));
                $check_inser = $result->rowCount();
                if($check_inser == 1) 
                {
                    $sqlDelete = "DELETE FROM users_pending WHERE token=?";
                    $result1= $this->bdd->Request($sqlDelete,array($token));
                    if($result1->rowCount() > 0)
                    {
                        return "#user_activate_succes";
                    }

                }
            else
            {

                // if($check['identifiant'])
            }
            }

        }
            return "#dont_activate";
    }

    function GetById($args)
    {
        $sql = "SELECT * FROM users WHERE id=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();
        if($donnees[0] != null){
            return new utilisateur_model($donnees[0]);
        }
        return null;
    }

    function modif($pseudo, $naissance,$email) 
    {
        $db = $this->bdd;
        if($pseudo == $_SESSION['Connected']->pseudo && $email == $_SESSION['Connected']->email && $naissance == $_SESSION['Connected']->naissance)
        {
            return "#no_change";
        }
        if($pseudo != $_SESSION['Connected']->pseudo && $email == $_SESSION['Connected']->email && $naissance == $_SESSION['Connected']->naissance)
        {
            $sqlSelect = "SELECT * FROM users WHERE pseudo = ?";
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
        if($pseudo == $_SESSION['Connected']->pseudo && $email != $_SESSION['Connected']->email && $naissance == $_SESSION['Connected']->naissance)
        {
            $sqlSelect = "SELECT * FROM users WHERE email = ?";
            $result = $this->bdd->Request($sqlSelect, array($email));
            $check_email = $result->fetchALL();
            if (count($check_email) == 0)
            {
                if ($_SESSION['Connected']->SetEmail($email))
                    return "#email_modif_ok";
                else
                    return "#email_crit_fail";
            }
            else 
            {
                return "#email_exist";
            }
        }
        if($pseudo == $_SESSION['Connected']->pseudo && $email == $_SESSION['Connected']->email && $naissance != $_SESSION['Connected']->naissance)
        {
                if ($_SESSION['Connected']->SetNaissance($naissance))
                    return "#naissance_modif_ok";
                else
                    return "#naissance_crit_fail";
        }
        if($pseudo != $_SESSION['Connected']->pseudo && $email != $_SESSION['Connected']->email && $naissance != $_SESSION['Connected']->naissance)
        {
            $sqlSelect = "SELECT * FROM users WHERE pseudo = ?";
            $result = $this->bdd->Request($sqlSelect, array($pseudo));
            $check_pseudo = $result->fetchALL();
            if (count($check_pseudo) == 0)
            {
                $sqlSelect = "SELECT * FROM users WHERE email = ?";
                $result = $this->bdd->Request($sqlSelect, array($email));
                $check_email = $result->fetchALL();
                if (count($check_email) == 0)
                {
                    $edit_profil = $_SESSION['Connected']->SetProfil($pseudo,$naissance, $email);
                }
                else
                {
                    return "#email_exist";
                }
            }
            else
            {
                return "#pseudo_exist";
            }
            return "#profil_edit_ok";
        }
    }

    function ChangePwd($mdp, $new_mdp){
        $sqlSelect = "SELECT mdp FROM users WHERE id=?";
        $result = $this->bdd->Request($sqlSelect, array($_SESSION['Connected']->ID));
        $check_pwd = $result->fetch();
        if(password_verify($mdp,$check_pwd["mdp"]))
        {
            $pwd_hache = password_hash($new_mdp, PASSWORD_DEFAULT);
            if(password_verify($new_mdp, $check_pwd["mdp"]))
                return "#no_change_pwd";
            $sqlUpdate = "UPDATE users SET mdp =? WHERE id =?";
            $result = $this->bdd->Request($sqlUpdate,array($pwd_hache,$_SESSION['Connected']->ID));
            return "#Pwd_success";
        }
        else { return "#pwd_fail";}
        var_dump($check_pwd["mdp"]);
        die();
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

    function modif_user($id, $user, $email, $pseudo, $sexe, $nom, $prenom, $naissance) 
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
            $userModel = new Utilisateur_model($users);
            $userModel->SetUser($user, $email, $pseudo, $sexe, $nom, $prenom, $naissance);
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

    function insert_token($id){
        $token = $this->controller->token32();
        $SqlSelect = "SELECT * FROM reset_password WHERE id_user=?";
        $result= $this->bdd->Request($SqlSelect,array($id));
        $check_id = $result->fetch();
        if ($check_id != null)
        {
            $SqlUpdate= "UPDATE reset_password SET token=? WHERE id_user=?";
            $result = $this->bdd->Request($SqlUpdate,array($token,$id));
        }
        else{
        $SqlInsert = "INSERT INTO reset_password (token,id_user) VALUES (?,?)";
        $result = $this->bdd->Request($SqlInsert,array($token,$id));}
    }
    function recup_token($id){
        $sqlSelect = "SELECT * FROM reset_password WHERE id_user=?";
        $result = $this->bdd->Request($sqlSelect, array($id));
        $check_token = $result->fetch();
        if($check_token !=null)
            return $check_token;
    }

    function recup_mail(){
        $SqlSelect = "SELECT * FROM mails_template WHERE fonction = ?";
        $fonction = "reset_pwd";
        $result = $this->bdd->Request($SqlSelect,array($fonction));
        $check_mail = $result->fetch();
        if($check_mail !=null) {
            $mail_obj = new Mails_model($check_mail);
            return $mail_obj;
        }
    }

    function resetpwd($compte) {
        $sqlSelect = "SELECT * FROM users WHERE identifiant=?";
        $result = $this->bdd->Request($sqlSelect,array($compte));
        $check_user = $result->fetch();
        if($check_user != false)
        {   
            $user_obj = new Utilisateur_model($check_user);
            $this->insert_token($user_obj->ID);
            $send = $this->send_mail_rcv($user_obj);
            return '#success_found_user';
        }
        else {
            $sqlSelect = "SELECT * FROM users WHERE email=?";
            $result = $this->bdd->Request($sqlSelect,array($compte));
            $check_mail = $result->fetch();
            if($check_mail != false)
            {
                // var_dump($)
                $user_obj = new Utilisateur_model($check_mail);
                $this->insert_token($user_obj->ID);
                $send = $this->send_mail_rcv($user_obj);
                return '#success_found_user';
            }
            else {
                return "#not_found_user";
            }
        }
    }    
    function update_pwd($token){
        $sqlSelect = "SELECT * FROM reset_password WHERE token=?";
        $result = $this->bdd->Request($sqlSelect, array($token));
        $token_check = $result->fetch();
        if($token_check != false)
        {
            $_SESSION['token']= $token;
            return array('true',$token_check[2]);
        }
        else 
        return 'false';   
    }

    function set_newmdp($mdp,$cmdp,$token){
        if($mdp == $cmdp){
            $mdp_hache = password_hash($mdp, PASSWORD_DEFAULT);
            $sqlSelect = "SELECT id_user FROM reset_password WHERE token=?";
            $result = $this->bdd->Request($sqlSelect,array($token));
            $check_token = $result->fetch();
            $sqlUpdate = "UPDATE users SET mdp=? WHERE id=?";
            $result = $this->bdd->Request($sqlUpdate,array($mdp_hache,$check_token[0]));
            $sqlDelete = "DELETE FROM reset_password WHERE token=?";
            $result_Delete = $this->bdd->Request($sqlDelete, array($token));
            return '#success_reset_pwd';
        }
        else
            return '#register_passwordDoesntMatch';
    }

    function send_mail_rcv($compte){
                $mail = $this->recup_mail();
                $recup_token = $this->recup_token($compte->ID);
                $mail->contenu = str_replace("{TOKEN}",$recup_token[1],$mail->contenu);
                $address = $this->controller->siteURL();
                $mail->contenu = str_replace("{ADDRESS}",$address,$mail->contenu);
                $this->controller->sendMail($compte->email,$mail->sujet,$mail->contenu);
    }
}

?>