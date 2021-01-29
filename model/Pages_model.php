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

    function __construct($arrayInfos)
    {
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->titre = $arrayInfos[1];
        $this->contenu = htmlspecialchars_decode($arrayInfos[2]);
        $this->url = $arrayInfos[3];
        $this->admin = $arrayInfos[4];
        $this->connected = $arrayInfos[5];
    }

    function SetNew($page_titre, $page_contenu, $page_url, $page_connect,$page_admin) 
    {
        $pageTitre = $page_titre;
        $pageContenu = htmlspecialchars($page_contenu);
        $pageurl = $page_url;
        $pageAdmin = $page_admin;
        $pageConnect = $page_connect;
            $db = $this->bdd;
            $sqlUpdate = "UPDATE page SET titre= ? , contenu=?, url=?, admin=?,connected=? WHERE id= ?";
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
