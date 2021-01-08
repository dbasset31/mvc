<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/utilisateurs_repo.php";
include_once "model/utilisateur_model.php";
class Utilisateur_controller extends controller{
    private $utilisateurs_repo = null;
    function __construct(){
        $this->utilisateurs_repo = new Utilisateur_repo();
    }
    function index() {
        return $this->view();
    }
    function login($data) { 
        global $txtManager;
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
        if (isset($_SESSION['Connected']))
        {
            return $this->view($_SESSION['Connected']);
        }
        else {
            return $this->otherView("login");
        }
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

    function logout() { 
        session_destroy();
        header('Location: /utilisateur/login');
    }

    function register() { 
        global $txtManager;
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
    function connexion() { 
    //     $this->utilisateurs_repo->connexion($_POST['login'],$_POST['password']);
     
    }
}