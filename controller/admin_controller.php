<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
include_once "config/bdd.php";
include_once "repository/admin_repo.php";
include_once "model/Utilisateur_model.php";
include_once "repository/news_repo.php";
include_once "model/News_model.php";
include_once "repository/utilisateurs_repo.php";
include_once "repository/settings_repo.php";
include_once "model/settings_model.php";
include_once "repository/page_repo.php";
include_once "repository/mail_repo.php";

class Admin_controller extends Controller{
    private $admin_repo=null;
    private $bdd;
    function __construct(){
        $this->bdd = new BDD();
        $this->admin_repo = new Admin_repo();
        $this->news_repo = new News_repo();
        $this->utilisateur_repo = new Utilisateur_repo();
        $this->settings_repo = new Settings_repo();
        $this->page_repo = new Pages_repo();
        $this->mail_repo = new Mails_repo();
      
       
        $this->CheckAdmin();
    }

    function index() {
        if(isset($_POST['nbNews'])){
            $result= $this->settings_repo->modif($_POST['nbNews']);
           
            return $this->view(array($_SESSION['Connected'],$this->settings_repo->GetAllSettings()));
        }
        if(isset($_POST['h1'])){
            $result= $this->settings_repo->modifColor($_POST['h1'],$_POST['h2'],$_POST['h3'],$_POST['h4'],$_POST['text'],$_POST['lien'],$_POST['label'],$_POST['header_color'],$_POST['footer_color']);
           
            return $this->view(array($_SESSION['Connected'],$this->settings_repo->GetAllSettings()));
        }
        return $this->view(array($_SESSION['Connected'],$this->settings_repo->GetAllSettings()));
    }

    function utilisateurs($data) {
        

                $result = $this->admin_repo->utilisateurs($data);
                return $this->view($result);

    }

    function edit_new($id)
    {
        if($id != "")
        {
            $news_model = $this->news_repo->GetById($id);
            if($news_model !=null)
            {
                if (isset($_POST['titre']))
                {
                    $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;","<script>","</script>","&lt;script&gt;","&lt;/script&gt;");
                    $tabRepl = array("[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]");
                    $nouvelleTitre = str_replace($tabSearch, $tabRepl, $_POST['titre']);
                    $nouvelleContenu = str_replace($tabSearch, $tabRepl, $_POST['contenu']);
                    return $this->view($this->news_repo->modif($id, $nouvelleTitre, $nouvelleContenu));
                }
                return $this->view($news_model);
            }
            header('location: /admin/liste_news');
        }
        return $this->otherView("liste_news",$this->admin_repo->liste_news());
    }

    function edit_user($id)
    {
        if($id !="")
        {
            $user_model = $this->utilisateur_repo->GetById($id);
            if($user_model !=null){
                if (isset($_POST['identifiant']))
                {
                    return $this->view($this->utilisateur_repo->modif_user($id, $_POST['identifiant'], $_POST['email'], $_POST['pseudo'], $_POST['sexe'], $_POST['admin'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['date_inscription'], $_POST['avatar']));
                }
                return $this->view($user_model);
            }
            else
            {
            header('location: /admin/utilisateurs');
            }
        }
        header('location: /admin/utilisateurs');
    }

    function delete_user($id)
    {
        global $txtManager;
        if($this->utilisateur_repo->GetById($id) != null)
        {
            $result = $this->utilisateur_repo->delete($id);
            if($result == null){
                header('location:/admin/utilisateurs');
            }
            else{
                if ($txtManager->Compare($result,"#user_delete_succes") || $txtManager->Compare($result,"#user_delete_fail") )
                {                    
                    return $this->otherView("utilisateurs", array($result, $this->admin_repo->utilisateurs()));
                }
            }
        }
        header('location:/admin/utilisateurs');
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

    function nb_news()
    {
        $setting_model = $this->settings_repo->GetAllSettings();
                if (isset($_POST['nb']))
                {
                    return $this->otherView("index", $this->settings_repo->modif($_POST['nb']));
                }
                return $this->otherView("index",$setting_model);
    }

    function page($data) {
        

        $result = $this->admin_repo->utilisateurs($data);
        return $this->view($result);
    }
    
    function create_page() 
        {
                    global $txtManager;
                    if (isset($_POST['titre']) && !empty($_POST["titre"]) && !empty($_POST["contenu"] && !empty($_POST["url"])))
                    {
                        
                        if(isset($_POST['admin']) && isset($_POST['Connexion']))
                        {
                            $admin=1;
                            $connect=1;
                            $result = $this->admin_repo->create_page($_POST['titre'],$_POST['contenu'],$_POST['url'],$admin,$connect);
                        }
                        
                        if(isset($_POST['admin']))
                        {
                            $admin=1;
                            $connect=0;
                            $result = $this->admin_repo->create_page($_POST['titre'],$_POST['contenu'],$_POST['url'],$admin,$connect);
                        }

                        if(!isset($_POST['admin']) && !isset($_POST['Connexion']))
                        { 
                            $admin=0;
                            $connect=0;
                            $result = $this->admin_repo->create_page($_POST['titre'],$_POST['contenu'],$_POST['url'],$admin,$connect);
                        }

                        if ($txtManager->Compare($result,"#create_page_success"))
                        {
                            return $this->view($result);
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
        function liste_page() {
        
            $result = $this->admin_repo->liste_page();
            return $this->view($result);
        }

        function delete_page($id)
    {
                global $txtManager;
                if($this->page_repo->GetById($id) != null)
                    $result = $this->page_repo->delete($id);
                else
                {
                    return $this->otherView("liste_page",$this->admin_repo->liste_page());
                }
                
                if ($txtManager->Compare($result,"#page_delete_succes"))
                {                    
                    return $this->otherView("liste_page", array($result, $this->admin_repo->liste_page()));
                }
                else 
                    return $this->otherView("liste_page", $result);
    }

    function edit_page($id)
    {
                $page_model = $this->page_repo->GetById($id);
                if($page_model != null)
                {
                    if (isset($_POST['titre']))
                    {
                        $titre = $_POST['titre'];
                        $contenu = $_POST['contenu'];
                        $url = $_POST['url'];
                        if(isset($_POST['Connexion'])){
                            $connect = $_POST['Connexion'];
                            $connect=1;
                        }
                        else 
                            $connect=0;
                        if(isset($_POST['admin'])){
                            $admin = $_POST['admin'];
                            $admin=1;
                        }
                            else 
                                $admin=0;
                        return $this->view($this->page_repo->modif($id, $titre, $contenu,$url,$connect,$admin));
                    }
                    return $this->view($page_model);
                }
                header('location:/admin/liste_page');
    }
    function mail() {
        
        $result = $this->admin_repo->liste_mail();
        return $this->view($result);
    }

    function edit_mail($id)
    {
        if($id != "")
        {
            $mail_model = $this->mail_repo->GetById($id);
            if($mail_model !=null)
            {
                if (isset($_POST['sujet']))
                {
                    $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;","<script>","</script>","&lt;script&gt;","&lt;/script&gt;");
                    $tabRepl = array("[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]");
                    $mailSujet = str_replace($tabSearch, $tabRepl, $_POST['sujet']);
                    $mailContenu = str_replace($tabSearch, $tabRepl, $_POST['contenu']);
                    return $this->view($this->mail_repo->modif($id, $mailSujet, $mailContenu));
                }
                return $this->view($mail_model);
            }
            header('location: /admin/mail');
        }
        return $this->otherView("mail",$this->admin_repo->liste_mail());
    }
}