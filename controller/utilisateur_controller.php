<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/utilisateurs_repo.php";
class Utilisateur_controller extends Controller{
    private $utilisateurs_repo = null;
    protected $bdd=null;
    function __construct(){
        $this->utilisateurs_repo = new Utilisateur_repo();
        $this->bdd = new BDD();
    }
    function index() {
        $this->CheckConnect();
        return $this->view();
    }
    function login($data) { 
        global $txtManager;
        if(isset($_SESSION['Connected']))
            header('Location: /utilisateur/compte');
        if (isset($_POST['login']))
        {
            $result = $this->utilisateurs_repo->login($_POST['login'],$_POST['password']);
         
            if ($result instanceof Utilisateur_model)
            { 
                if ($result->admin)
                {
                    header('Location: /admin');
                }
                else
                {
                header('Location: /utilisateur/compte');
                }
            }
            else 
            {
                return $this->view($result);
            }
        }
        return $this->view();
    }
    
    function compte() { 
        $this->CheckConnect();
        $user = $this->utilisateurs_repo->GetById($_SESSION['Connected']->ID);
            return $this->view($user);
    }
    
     function modifier() {
        $this->CheckConnect();
        if (isset($_POST['pseudo']) || isset($_POST['email']) || isset($_POST['naissance']))
        {
            if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['naissance']))
                return $this->view("#Empty_field_modif");
            return $this->view($this->utilisateurs_repo->modif($_POST['pseudo'],$_POST['naissance'],$_POST['email']));
        }
        if(isset($_POST['mdp']) || isset($_POST['nmdp']) || isset($_POST['cnmdp'])){
            if(empty($_POST['mdp'])|| empty($_POST['nmdp']) || empty($_POST['cnmdp']))
                return $this->view("#Empty_field_pwd");
            if($_POST['nmdp'] != $_POST['cnmdp'])
                return $this->view("#pwd_not_match");
            $changePass = $this->utilisateurs_repo->ChangePwd($_POST['mdp'],$_POST['nmdp']);
                return $this->view($changePass);
        }
        return $this->view();
     }

    function avatar() 
    {
        $this->CheckConnect();
        $idUser = $this->utilisateurs_repo->GetById($_SESSION['Connected']->ID);
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
        if (isset($_POST["submit"]))
        {
            if (!empty($_FILES["fileToUpload"]['name']))
            {
                $target_dir = "uploads/avatars/";
                $target_file = $target_dir .$idUser->ID."_".$d->format("d-m-Y_H-i-s_u")."-".rand(1465,9894)."-". basename(str_replace(" ","_",$_FILES["fileToUpload"]["name"]));

                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Vérification s'il s'agit d'une vrai image
                if(isset($_POST["submit"])) 
                {
                    if(!empty($_FILES["fileToUpload"]["tmp_name"]))
                    {
                        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                        if($check !== false) {
                            $uploadOk = 1;
                        } else {
                            $uploadOk = 0;
                            $result = "#unknow_img";
                            return $this->view($result);
                        }
                    }
                }
                // Vérification si le fichier existe
                if (file_exists($target_file)) {
                $uploadOk = 0;
                }

                // Verification de la taille
                if ($_FILES["fileToUpload"]["size"] > 8000000) {
                $uploadOk = 0;
                $result = "#size_trop_grande";
                return $this->view($result);
                }

                // Autorisation format JPG PNG GIF
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $uploadOk = 0;
                $result = "#format_not_allowed";
                return $this->view($result);
                }

                // Verification si $uploadOD est à 0
                if ($uploadOk == 0) {
                return $this->view("#avatar_modif_fail");
                // Si tout est ok, on upload
                } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $retour = "#avatar_modif_ok";
                    return $this->view($this->utilisateurs_repo->modif_avatar($target_file));
                } else { //Sinon on upload pas et on donne une erreur
                    return $this->view("#avatar_modif_fail");
                }
                }
            }
            else
            {
                $result = "#empty_avatar";
                return $this->view($result);
            }
        }
        else
        {
            return $this->view();
        }
    }

    function logout() 
    { 
        $this->CheckConnect();
        session_destroy();
        header("location: /utilisateur/login");
        return $this->otherview("login");
    }

    function register() { 
        global $txtManager;
        if(isset($_SESSION["Connected"]))
            header('Location: /utilisateur/compte');
        if (isset($_POST['login'])){
            $token = $this->token32();
            $ip_user = $_SERVER['REMOTE_ADDR'];
            $result = $this->utilisateurs_repo->register($_POST['login'],$_POST['password'],$_POST['conf_password'],$_POST['nom'],$_POST['prenom'],$_POST['naissance'], $_POST['email'],$_POST['pseudo'],$_POST['sexe'],$token,$ip_user);
            if ($txtManager->Compare($result[0],"#register_success"))
            {
                $sqlSelec="SELECT Contenu FROM mails_template WHERE fonction='register'";
                $requ=$this->bdd->Request($sqlSelec);
                $contenu= $requ->fetch();
                $sqlSelec="SELECT Sujet FROM mails_template WHERE fonction='register'";
                $requ=$this->bdd->Request($sqlSelec);
                $Sujet= $requ->fetch();
                $address = $this->siteURL();
                $contenu = str_replace("{COMPTE}",$result[2],$contenu);
                $contenu = str_replace("{MDP}",$result[3],$contenu);
                $contenu = str_replace("{ADDRESS}",$address,$contenu);
                $contenu = str_replace("{TOKEN}",$result[4],$contenu);
                $object="test";
                $mail= $this->sendMail($result[1],$Sujet['Sujet'],$contenu[0]);
                if($mail == "#Mail_send")
                {
                    return $this->otherView("login", $result[0]);
                }
                else 
                    return $this->otherView("login", "#Echec_SendMail");
            }
            else
            {
            return $this->view($result); 
            }   
        }
            return $this->view();
    }
    function activate($args){
        if($args !=null)
        {
            $activate = $this->utilisateurs_repo->activate($args);
            return $this->otherView("login",$activate);
        }
    }
    function credit_point()
    {
        global $txtManager;
        if(isset($_POST['code1']))
        {
            $result = $this->utilisateurs_repo->CheckCode($_POST['idd'],$_POST['idp'],$_POST['DATAS'],$_POST['code1']);
            
            if ($result[0] == "#code_ok")
            {
                $maj = $this->utilisateurs_repo->UpdateSolde($_SESSION['Connected']->ID,$result);
                if ($maj[1] == "#update_solde_ok")
                {
                    return $this->view($maj);
                }
                return $this->view($maj);
            }
            else 
            {
                return $this->view($result);
            }
        }
        return $this->view();
    }

    function resetpwd($data) { 
        global $txtManager;
        if(isset($_SESSION['Connected']))
            header('Location: /utilisateur/compte');
        if (isset($_POST['login']))
        {
            $user = $this->bdd->secure($_POST['login']);
            $result = $this->utilisateurs_repo->resetpwd($user);
            if($result == "#success_found_user")
                return $this->otherView("login",$result);
            else
                return $this->view($result);
        }
        if($data != null)
        {
            $data = $this->bdd->secure($data);
            $result = $this->utilisateurs_repo->update_pwd($data);
            if($result[0] == 'true'){
                return $this->view($result[0]);
            }
            else
            return $this->otherView('login');
        }
        if(isset($_POST['mdp']) && isset($_POST['cmdp']) && $_POST['mdp'] != null && $_POST['cmdp'] != null){
            $mdp = $this->bdd->secure($_POST['mdp']);
            $cmdp = $this->bdd->secure($_POST['cmdp']);
            $result = $this->utilisateurs_repo->set_newmdp($mdp,$cmdp,$_SESSION['token']);
            if($result=="#register_passwordDoesntMatch"){
                return $this->view($result);
            } 
            session_destroy();
            return $this->otherView("login",$result);
        }
        return $this->view();
    }
}