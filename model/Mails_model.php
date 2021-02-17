<?php 
include_once "config/bdd.php";
class Mails_model
{
    protected $bdd = null;
    public $ID;
    public $fonction;
    public $sujet;
    public $contenu;
    private $tabSearch;
    private $tabRepl;
    private $secure;


    function __construct($arrayInfos)
    {
        $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]");
        $secure = str_replace($tabSearch, $tabRepl, $arrayInfos[3]);
        $this->bdd = new BDD();
        $this->ID = $arrayInfos[0];
        $this->fonction = $arrayInfos[1];
        $this->sujet = $arrayInfos[2];
        $this->contenu = $secure;
    }

    function SetMail($sujet, $contenu) 
    {
        $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;");
        $tabRepl = array("[REMOVED]","[/REMOVED]");
        $MailSujet = str_replace($tabSearch, $tabRepl, $sujet);
        $MailContenu = str_replace($tabSearch, $tabRepl, $contenu);
            $db = $this->bdd;
            $sqlUpdate = "UPDATE mails_template SET sujet= ? , contenu=? WHERE fonction= ?";
            $result = $db->Request($sqlUpdate,array($MailSujet,$MailContenu, $this->fonction));
            $check_insert = $result->rowCount();
            if ($check_insert > 0)
            {
                $this->sujet = $MailSujet;
                $this->contenu = $MailContenu;
                return true;
            }
            return false;
    }

}



?>