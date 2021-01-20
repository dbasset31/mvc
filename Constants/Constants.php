<?php 
global $id;
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
$txtManager->AddTxt("#news_not_empty", "Le titre ou le contenu n'est pas rempli.");
////////////////////////////////////////////////////////END Add nouvelle /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Delete nouvelle /////////////////////////////////////////////////////
$txtManager->AddTxt("#new_delete_succes", "Nouvelle supprimée avec succès ! ");
$txtManager->AddTxt("#new_delete_fail", "Echec de la suppression !");
////////////////////////////////////////////////////////END Delete nouvelle /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Modif Utilisateur /////////////////////////////////////////////////////
$txtManager->AddTxt("#user_modif_ok", "Utilisateur modifié avec succès !");
$txtManager->AddTxt("#user_crit_fail", "Echec modification utilisateur !");
////////////////////////////////////////////////////////END Modif Utilisateur /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Delete Utilisateur /////////////////////////////////////////////////////
$txtManager->AddTxt("#user_delete_succes", "Utilisateur supprimé avec succès !");
$txtManager->AddTxt("#user_delete_fail", "Echec de la suppression de l'utilisateur !");
////////////////////////////////////////////////////////END Delete Utilisateur /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Modif Avatar Utilisateur /////////////////////////////////////////////////////
$txtManager->AddTxt("#avatar_modif_ok ", "Avatar modifié avec succès !");
$txtManager->AddTxt("#avatar_modif_fail", "Echec de la modification de l'avatar !");
$txtManager->AddTxt("#size_trop_grande", "L'image dépasse 2Mo !");
$txtManager->AddTxt("#format_not_allowed", "Le format d'image n'est pas autorisé !");
////////////////////////////////////////////////////////END modif avatar /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Create Page /////////////////////////////////////////////////////
$txtManager->AddTxt("#create_page_success", "Nouvelle page créée avec succès !");
$txtManager->AddTxt("#page_NonInserted", "Echec de la creation de la page !");
$txtManager->AddTxt("#page_not_empty", "Le titre, le contenu ou l'url n'est pas rempli.");
////////////////////////////////////////////////////////END create page /////////////////////////////////////////////////////

?>