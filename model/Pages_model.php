<?php 
include_once "config/bdd.php";
class Pages_model
{
    protected $bdd = null;
    public $ID;
    public $titre;
    public $contenu;
    public $url;
    public $admin;
    public $connected;
    private $tabSearch;
    private $tabRepl;
    private $secure;


    function __construct($arrayInfos)
    {
        $tabSearch = array("&lt;script&gt;","&lt;/script&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]");
        $secure = str_replace($tabSearch, $tabRepl, $arrayInfos[2]);
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->titre = $arrayInfos[1];
        $this->contenu = $secure;
        $this->url = $arrayInfos[3];
        $this->admin = $arrayInfos[4];
        $this->connected = $arrayInfos[5];
    }

    function SetNew($page_titre, $page_contenu, $page_url, $page_connect,$page_admin) 
    {
        $tabSearch = array("&lt;script&gt;","&lt;/script&gt;","&lt;/script&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]");
        $pageTitre = str_replace($tabSearch, $tabRepl, $page_titre);
        $pageContenu = str_replace($tabSearch, $tabRepl, $page_contenu);
        $pageurl = str_replace($tabSearch, $tabRepl, $page_url);
        $pageAdmin = str_replace($tabSearch, $tabRepl, $page_admin);
        $pageConnect = str_replace($tabSearch, $tabRepl, $page_connect);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE pages SET titre= ? , contenu=?, url=?, admin=?,connected=? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($pageTitre,$pageContenu,$pageurl,$pageAdmin,$pageConnect, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->titre = $pageTitre;
                $this->contenu = $pageContenu;
                $this->url = $pageurl;
                $this->admin = $pageAdmin;
                $this->connected = $pageConnect;
                return true;
            }
            return false;
    }
    
}
