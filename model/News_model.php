<?php 
include_once "config/bdd.php";
class News_model
{
    protected $bdd = null;
    public $ID;
    public $titre;
    public $contenu;
    public $date;
    private $tabSearch;
    private $tabRepl;
    private $secure;


    function __construct($arrayInfos)
    {
        $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]");
        $secure = str_replace($tabSearch, $tabRepl, $arrayInfos[2]);
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->titre = $arrayInfos[1];
        $this->contenu = $secure;
        $this->date = $arrayInfos[3];
    }

    function SetNew($new_titre, $new_contenu) 
    {
        $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]");
        $nouvelleTitre = str_replace($tabSearch, $tabRepl, $new_titre);
        $nouvelleContenu = str_replace($tabSearch, $tabRepl, $new_contenu);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE news SET titre= ? , contenu=? WHERE id= ?";
            $result = $db->Request($sqlUpdate,array($nouvelleTitre,$nouvelleContenu, $this->ID));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->titre = $nouvelleTitre;
                $this->contenu = $nouvelleContenu;
                return true;
            }
            return false;
    }

}



?>