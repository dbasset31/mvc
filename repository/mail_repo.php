<?php
include_once "config/bdd.php";
include_once "model/Mails_model.php";

class Mails_repo
{
    protected $bdd = null;
    function __construct()
    {
        $this->bdd = new BDD();
    }

    function GetById($args)
    {
        $sql = "SELECT * FROM mails_template WHERE id=?";
        $result = $this->bdd->Request($sql,array($args));
        $donnees = $result->fetchALL();
        if($result->rowCount() > 0)
        {
            $tabSearch = array("&lt;p&gt;&amp;lt;script&amp;gt;","&amp;lt;/script&amp;gt;&lt;br&gt;&lt;/p&gt;","<script>","</script>","&lt;script&gt;","&lt;/script&gt;");
            $tabRepl = array("[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]","[REMOVED]","[/REMOVED]");
            $mailContenu = str_replace($tabSearch, $tabRepl, $donnees[0]);
            return new Mails_model($mailContenu);
        }
        return null;
    }

    function modif($id, $sujet, $contenu) 
    {     
          $db = $this->bdd;
          $sqlSelect = "SELECT * FROM mails_template WHERE id= ?";
          $result = $this->bdd->Request($sqlSelect, array($id));
          $check_mail = $result->fetchALL();
            if ($result->rowCount() > 0)
            {
                $mail = new Mails_model($check_mail[0]);
                $mail->SetMail($sujet, $contenu);
                return array("#mail_modif_ok",$mail);
            }
            else
                return array("#mail_crit_fail",$mail);
          }
}