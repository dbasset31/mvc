<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/admin_repo.php";
include_once "model/Utilisateur_model.php";
include_once "repository/news_repo.php";
include_once "model/News_model.php";
include_once "repository/utilisateurs_repo.php";
class Admin_controller extends controller{
    private $admin_repo=null;
    function __construct(){
        $this->admin_repo = new Admin_repo();
        $this->news_repo = new News_repo();
        $this->utilisateur_repo = new Utilisateur_repo();
      
       
        $this->CheckAdmin();
    }

    function index() {
        return $this->view($_SESSION['Connected']);
    }

    function page($args) { 
        
        $user = $args==1?"Lilian" : "Dono";
        return $this->view($user);
        
    }
    function utilisateurs($data) {
        

                $result = $this->admin_repo->utilisateurs($data);
                return $this->view(array($_SESSION['Connected'], $result));

    }

    function edit_new($id)
    {
                $news_model = $this->news_repo->GetById($id);
                if (isset($_POST['titre']))
                {
                    return $this->view($this->news_repo->modif($id, $_POST['titre'], $_POST['contenu']));
                }
                return $this->view(array($_SESSION['connected'],$news_model));
    }

    function edit_user($id)
    {
                $user_model = $this->utilisateur_repo->GetById($id);
                if (isset($_POST['id']))
                {
                    return $this->view($this->utilisateur_repo->modif_user($_POST['id'], $_POST['identifiant'], $_POST['email'], $_POST['pseudo'], $_POST['sexe'], $_POST['admin'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['date_inscription'], $_POST['avatar']));
                }
                return $this->view($user_model);
    }

    function delete_user($id)
    {
                global $txtManager;
                if($this->utilisateur_repo->GetById($id) != null)
                    $result = $this->utilisateur_repo->delete($id);
                else
                {
                    return $this->otherView("utilisateurs",$this->admin_repo->utilisateurs());
                }
                
                if ($txtManager->Compare($result,"#user_delete_succes"))
                {                    
                    return $this->otherView("utilisateurs",array($result, $this->admin_repo->utilisateurs()));
                }
                else 
                return $this->otherView("utilisateurs", $result);
    }

    function delete_new($id)
    {
                global $txtManager;
                if($this->news_repo->GetById($id) != null)
                    $result = $this->news_repo->delete($id);
                else
                {
                    return $this->otherView("liste_news",$this->admin_repo->liste_news());
                }
                
                if ($txtManager->Compare($result,"#new_delete_succes"))
                {                    
                    return $this->otherView("liste_news", array($result, $this->admin_repo->liste_news()));
                }
                else 
                    return $this->otherView("liste_news", $result);
    }

    function liste_news() {
        
                $result = $this->admin_repo->liste_news();
                return $this->view($result);
            }
            

    function add_new() 
    {
                global $txtManager;
                if (isset($_POST['titre']) && !empty($_POST["titre"]) && !empty($_POST["contenu"]))
                {
                    $result = $this->admin_repo->add_new($_POST['titre'],$_POST['contenu']);
                    if ($txtManager->Compare($result,"#add_new_success"))
                    {
                        return $this->otherView("liste_news", array($result,$this->admin_repo->liste_news($result)));
                    }
                    else
                    { 
                    return $this->view($result);
                    }
                }
                else
                {
                    return $this->view(!isset($_POST['titre']) ? null : "#news_not_empty"); 

                }
    }
}
