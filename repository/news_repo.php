<?php
include_once "config/bdd.php";
include_once "model/News_model.php";

class News_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    function index($id)
    {
        $newsPerPage = ConstantVariables::$NbNews;
        $sqlPagi = "SELECT COUNT(id) AS nb FROM news";
        $res = $this->bdd->Request($sqlPagi);
        $donnePagi = $res->fetch();
        $nb= $donnePagi['nb'];
        $nbActu= $nb;
        $pPage = ConstantVariables::$NbNews;
        $nbPage = ceil($nb/$pPage);
        
        $nbNews = $id == null ? 1 : $id;
        if($nbNews == 1)
        {
            $nbNews = 0;
        }
        else {
           $nbNews =  $id * $newsPerPage -$newsPerPage;
        }
        
        $sql = "SELECT id, titre, contenu, date FROM news ORDER BY date DESC LIMIT ".$nbNews.",$newsPerPage";
        $result = $this->bdd->Request($sql);
        $donnes = $result->fetchALL();
        $objects = array();

        foreach ($donnes as $ob)
        {
            array_push($objects, new News_model($ob));
        }
        return array($objects,$nb,$nbActu, $pPage,$nbPage);
    }
    function GetById($args)
    {
        $sql = "SELECT * FROM news WHERE id=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();
        if($result->rowCount() > 0)
        {
            $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;","<script>","</script>","&lt;script&gt;","&lt;/script&gt;");
            $tabRepl = array("[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]");
            $nouvellecontenu = str_replace($tabSearch, $tabRepl, $donnees[0]);
            return new News_model($nouvellecontenu);
        }
        return null;
    }

    function modif($id, $titre, $contenu) 
    {     
          $db = $this->bdd;
          $sqlSelect = "SELECT * FROM news WHERE id= ?";
          $result = $this->bdd->Request($sqlSelect, array($id));
          $check_nouvelle = $result->fetchALL();
            if ($result->rowCount() > 0)
            {
                $new = new News_model($check_nouvelle[0]);
                $new->SetNew($titre, $contenu);
                return array("#new_modif_ok",$new);
            }
            else
                return array("#new_crit_fail",$new);
          }

    function delete($id){
        $db = $this->bdd;
        $sqlDelete = "DELETE FROM news WHERE id=$id";
        $result = $this->bdd->Request($sqlDelete);
        if($result->rowCount() > 0)
        return "#new_delete_succes";
            return ("#new_delete_fail");
    }
}
