<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "repository/admin_repo.php";
include_once "model/Utilisateur_model.php";
include_once "repository/news_repo.php";
include_once "model/News_model.php";
class Admin_controller extends controller{
    private $admin_repo=null;
    function __construct(){
        $this->admin_repo = new Admin_repo();
        $this->news_repo = new News_repo();
    }

    function index() {
        if (isset($_SESSION['Connected']))
        {
            if ($_SESSION['Connected']->admin)
                return $this->view($_SESSION['Connected']);
            header('Location: /error/perdu');
        }
        else
        {
            header('Location: /error/perdu');
        }    
        
    }

    function page($args) { 
        if (isset($_SESSION['Connected']))
        {
            if ($_SESSION['Connected']->admin)
            {
        $user = $args==1?"Lilian" : "Dono";
        return $this->view($user);
            }
            header('Location: /error/perdu');
        }
        header('Location: /error/perdu');
    }

    function utilisateurs($data) {
         if (isset($_SESSION['Connected']))
             if ($_SESSION['Connected']->admin)
             {
                $result = $this->admin_repo->utilisateurs($data);
                return $this->view($result);
             }
             else
             {
                 header('Location: /error/perdu');
             }
         header('Location: /error/perdu');
    }

    function edit_new($id)
    {
        if (isset($_SESSION['Connected']))
            if ($_SESSION['Connected']->admin)
            {
                $news_model = $this->news_repo->GetById($id);
                if (isset($_POST['titre']))
                {
                    return $this->view($this->news_repo->modif($id, $_POST['titre'], $_POST['contenu']));
                }
                return $this->view($news_model);
            }
            else
            {
                header('Location: /error/perdu');
            }
        header('Location: /error/perdu');
    }

    function liste_news() {
        if (isset($_SESSION['Connected']))
            if ($_SESSION['Connected']->admin)
            {
                $result = $this->admin_repo->liste_news();
                return $this->view($result);
            }
            else
            {
                header('Location: /error/perdu');
            }
        header('Location: /error/perdu');
    }

    function add_new() 
    {
        if (isset($_SESSION['Connected']))
        {
            if ($_SESSION['Connected']->admin)
            {
                global $txtManager;
                if (isset($_POST['titre'], ))
                {
                    if(isset($_POST['contenu']))
                    {
                        $result = $this->admin_repo->add_new($_POST['titre'],$_POST['contenu']);
                        if ($txtManager->Compare($result,"#add_new_success"))
                        {
                            return $this->otherView("liste_news", array($result,$this->admin_repo->liste_news()));
                        }
                        else
                        { 
                        return $this->view($result);
                        }
                    }
                    else
                    {
                        $msg = $txtManager->DisplayText("#news_not_empty");
                    }
                }
                else
                {
                    return $this->view(); 
                }
            }
            else
            {
                header('Location: /error/perdu');
            }
        }
        else 
        {
            header('Location: /error/perdu');
        }
    }
}
