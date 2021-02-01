<?php

class BDD 
{
    function getBDD()
    {
        $user = "root";
        $pass = "";
        $db = null;
        try 
        {
            $db = new PDO('mysql:host=localhost;dbname=mvc', $user, $pass);
        } 
        catch (PDOException $e) 
        {
            print "La base de donnée est innaccessible, veuillez contacter un administrateur.";
        }
        finally 
        {
            return $db;
        }
    }

    function secure($var)
    {
        $var = str_replace("<script>","[Removed]",$var);
        $var = str_replace("</script>","[/Removed]",$var);
        $var = stripslashes($var);
        $var = trim($var);
        $var = htmlspecialchars($var);
        return $var;
    }
    function secure_adm($var)
    {
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

    function Request($requete,$values=null,$debug = false)
    {

        $db = $this->getBDD();
        if($db != null){
            $db->beginTransaction();
            $manager = $db->prepare($requete);
            
            try
            {
                if($values==null)
                {
                    $manager->execute();
                }
                else
                {
                    $manager->execute($values);
                }
                if ($debug)
                {
                    var_dump($manager);
                    die();
                }
                $db->commit();
            
            }
            catch (PDOException $e)
            {
                $db->rollback();
                print "<pre>Erreur !: " . $e->getMessage() . "<br/>";
            }
            finally
            {
                return $manager;
            }
        }
        else 
        die();
    }


}


?>
