<?php 

class TextManager
{
    private $txtArray = array();
    function __construct()
    {

    }

    public function DisplayText($txtCode)
    {
        if($this->CheckExist($txtCode))
        {
            echo $this->txtArray[$txtCode];
        }      
    }  

    private function CheckExist($txtCode)
    {
        foreach($this->txtArray as $key => $value)
        {
            if($key == $txtCode)
            {
                return true;
            }
        }
        return false;
    }

    public function AddTxt($txtCode, $string)
    {
        $this->txtArray[$txtCode] = $string;
    }

    public function Compare($toCompare, $compareTo)
    {
        foreach($this->txtArray as $key => $value)
        {
            if($key == $compareTo)
            {
                if($key == $toCompare)
                    return true;
            }
        }
        return false;
    }
}

$txtManager = new TextManager();

////////////////////////////////////////////////////////////REGISTER////////////////////////////////////////////////////////////
$txtManager->AddTxt("#register_userNonInserted", "Il y a eu une problème lors de la création du compte");
$txtManager->AddTxt("#register_success", "Compte créer avec succès");
$txtManager->AddTxt("#register_passwordDoesntMatch", "les mots de passe ne correspondent pas.");
$txtManager->AddTxt("#register_userExist", "L'utilisateur existe déjà");
////////////////////////////////////////////////////////////END REGISTER////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////LOGIN////////////////////////////////////////////////////////
$txtManager->AddTxt("#login_userNotEx", "L'utilisateur n'existe pas.");
$txtManager->AddTxt("#login_pwdFail", "le mot de passe est incorrecte.");
///////////////////////////////////////////////////////////END LOGIN/////////////////////////////////////////////////////
//////////////////////////////////////////////////////////Modif Profil//////////////////////////////////////////////////
$txtManager->AddTxt("#pseudo_modif_ok", "Pseudo modifié avec succès !.");
$txtManager->AddTxt("#pseudo_crit_fail", "Impossible de modifier le pseudo, veuillez réessayer, si le problème persiste, contactez un administrateur.");
$txtManager->AddTxt("#pseudo_exist", "Le pseudonyme existe déjà.");
////////////////////////////////////////////////////////END MODIF PROFIL////////////////////////////////////////////////////
////////////////////////////////////////////////////////Modif nouvelle /////////////////////////////////////////////////////
$txtManager->AddTxt("#new_modif_ok", "Nouvelle modifiée avec succès !");
$txtManager->AddTxt("#new_crit_fail", "Impossible de modifier le new, veuillez réessayer, si le problème persiste, contactez un administrateur.");
////////////////////////////////////////////////////////END Modif nouvelle /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Add nouvelle /////////////////////////////////////////////////////
$txtManager->AddTxt("#add_new_success", "Nouvelle ajoutée avec succès !");
$txtManager->AddTxt("#news_NonInserted", "Echec de l'ajout de la new !");
$txtManager->AddTxt("#news_not_empty", "c'est vide")
////////////////////////////////////////////////////////END Add nouvelle /////////////////////////////////////////////////////
?>