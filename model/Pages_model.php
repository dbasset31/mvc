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
        $this->titre = htmlspecialchars_decode($arrayInfos[1]);
        $this->contenu = htmlspecialchars_decode($arrayInfos[2]);
        $this->url = htmlspecialchars_decode($arrayInfos[3]);
        $this->admin = htmlspecialchars_decode($arrayInfos[4]);
        $this->connected = htmlspecialchars_decode($arrayInfos[5]);
    }

    function SetNew($page_titre, $page_contenu, $page_url, $page_connect,$page_admin) 
    {
        $pageTitre = $this->bdd->secure($page_titre);
        $pageContenu = $this->bdd->secure($page_contenu);
        $pageurl = $this->bdd->secure($page_url);
        $pageAdmin = $this->bdd->secure($page_admin);
        $pageConnect = $this->bdd->secure($page_connect);
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
