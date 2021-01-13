<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/utilisateurs_repo.php";
include_once "model/utilisateur_model.php";
class Utilisateur_controller extends controller{
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
        if($_SESSION['Connected'])
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
                    //return $this->otherViewAndController("admin", "index",$result);
                header('Location: /utilisateur/compte');
                }
                    /* return $this->otherView("compte", $result); */
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
            return $this->view($_SESSION['Connected']);
    }
    
     function modifier() {
        if (isset($_SESSION['Connected']))
        {
             if (isset($_POST['pseudo']))
                return $this->view($this->utilisateurs_repo->modif($_POST['pseudo']));
            return $this->view($_SESSION['Connected']->pseudo);
        }
        else
            return $this->otherView("login");
     }

     function avatar() {
        if (isset($_SESSION['Connected']))
        {
            if (isset($_POST["submit"]))
            {
                $target_dir = "uploads/avatars/";
                $target_file = $target_dir . basename(str_replace(" ","_",$_FILES["fileToUpload"]["name"]));
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Vérification s'il s'agit d'une vrai image
                if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
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
                }

                // Verification si $uploadOD est à 0
                if ($uploadOk == 0) {
                return $this->view("#avatar_modif_fail");
                // Si tout est ok, on upload
                } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $retour = "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été upload.";
                    return $this->view($this->utilisateurs_repo->modif_avatar($target_file));
                } else { //Sinon on upload pas et on donne une erreur
                    return $this->view("#avatar_modif_fail");
                }
                }
            }
            else
            return $this->view();
        }
        header('Location: /utilisateur/login');
    }

    function logout() { 
        session_destroy();
        header('Location: /utilisateur/login');
    }

    function register() { 
        global $txtManager;
        if($_SESSION["Connected"])
            header('Location: /utilisateur/compte');
        if (isset($_POST['login'])){
            $result = $this->utilisateurs_repo->register($_POST['login'],$_POST['password'],$_POST['conf_password'],$_POST['nom'],$_POST['prenom'],$_POST['naissance'], $_POST['email'],$_POST['pseudo'],$_POST['sexe']);
            if ($txtManager->Compare($result,"#register_success"))
            {
                return $this->otherView("login", $result);
            }
            else
            {
            return $this->view($result); 
            }   
        }
            return $this->view();
    }
}