<?php 

class ConstantVariables
{
    public static $NbNews;

   static function Init()
    {
        $bdd = new BDD();
        ConstantVariables::$NbNews = $bdd->getBDD()->query("SELECT nbNews from settings")->fetch()[0];
        //echo "NbNews define to ".ConstantVariables::$NbNews;
    }
}

ConstantVariables::Init();

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
$txtManager->AddTxt("#register_userExist", "Le nom de compte est déjà utilisé");
$txtManager->AddTxt("#register_emailExist", "l'addresse email est déjà utilisé. Veuillez vous connecter avec votre compte.");
////////////////////////////////////////////////////////////END REGISTER////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////LOGIN////////////////////////////////////////////////////////
$txtManager->AddTxt("#login_userNotEx", "L'utilisateur n'existe pas.");
$txtManager->AddTxt("#login_pwdFail", "le mot de passe est incorrecte.");
///////////////////////////////////////////////////////////END LOGIN/////////////////////////////////////////////////////
//////////////////////////////////////////////////////////Activate Account /////////////////////////////////////////////////////
$txtManager->AddTxt("#user_activate_succes", "Votre compte a été activé avec succès. Vous pouvez dès à présent vous connecter.");
$txtManager->AddTxt("#user_already_activate", "Votre compte est déjà activé, vous pouvez vous connecter.");
$txtManager->AddTxt("#dont_activate", "Echec de l'activation du compte.");
//////////////////////////////////////////////////////////Modif Profil//////////////////////////////////////////////////
$txtManager->AddTxt("#pseudo_modif_ok", "Pseudo modifié avec succès !");
$txtManager->AddTxt("#profil_edit_ok", "Profil modifié avec succès !");
$txtManager->AddTxt("#email_modif_ok", "Adresse email modifié avec succès !");
$txtManager->AddTxt("#pseudo_crit_fail", "Impossible de modifier le pseudo, veuillez réessayer, si le problème persiste, contactez un administrateur.");
$txtManager->AddTxt("#pseudo_exist", "Le pseudonyme est déjà pris.");
$txtManager->AddTxt("#email_exist", "L'adresse email est déjà utilisée.");
$txtManager->AddTxt("#Empty_field_modif", "Veuillez remplir tous les champs.");
$txtManager->AddTxt("#Empty_field_pwd", "Veuillez remplir tous les champs.");
$txtManager->AddTxt("#no_change", "Aucun changement n'a été effectué.");
$txtManager->AddTxt("#no_change_pwd", "Mot de passe identique à l'actuel, veuillez entrer un mot de passe différent.");
$txtManager->AddTxt("#profil_edit_ok", "Profil modifié avec succès.");
$txtManager->AddTxt("#naissance_modif_ok", "Date de naissance modifiée avec succès !");
$txtManager->AddTxt("#naissance_crit_fail", "Impossible de modifier la date de naissance, veuillez réessayer, si le problème persiste, contactez un administrateur.");
$txtManager->AddTxt("#email_crit_fail", "Impossible de modifier l'adresse email', veuillez réessayer, si le problème persiste, contactez un administrateur.");
$txtManager->AddTxt("#pwd_fail", "Mot de passe incorrect !");
$txtManager->AddTxt("#pwd_not_match", "Les mot de passe ne correspondent pas !");
$txtManager->AddTxt("#Pwd_success", "Le mot de passe a été modifié.");
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
$txtManager->AddTxt("#avatar_modif_ok", "Avatar modifié avec succès !");
$txtManager->AddTxt("#avatar_modif_fail", "Echec de la modification de l'avatar !");
$txtManager->AddTxt("#size_trop_grande", "L'image dépasse 2Mo !");
$txtManager->AddTxt("#format_not_allowed", "Le format d'image n'est pas autorisé !");
$txtManager->AddTxt("#empty_avatar", "Aucun avatar choisi !");
$txtManager->AddTxt("#unknow_img", "L'image n'a pas pu être reconnu, veuillez vérifier qu'il s'agisse d'une véritable image !");
////////////////////////////////////////////////////////END modif avatar /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Create Page /////////////////////////////////////////////////////
$txtManager->AddTxt("#create_page_success", "Nouvelle page créée avec succès !");
$txtManager->AddTxt("#page_NonInserted", "Echec de la creation de la page !");
$txtManager->AddTxt("#page_not_empty", "Le titre, le contenu ou l'url n'est pas rempli.");
////////////////////////////////////////////////////////END create page /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Update Solde /////////////////////////////////////////////////////
$txtManager->AddTxt("#update_solde_ok", "Achat réussi, votre nouveau solde est de : ");
$txtManager->AddTxt("#update_solde_fail", "Echec de l'achat, veuillez contacter un administrateur.");
$txtManager->AddTxt("#code_fail", " est erroné ou déjà utilisé. Si ce n'est pas le cas, contactez un administrateur.");
////////////////////////////////////////////////////////END Update Solde /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Delete Page /////////////////////////////////////////////////////
$txtManager->AddTxt("#page_delete_succes", "Page supprimée avec succès ! ");
$txtManager->AddTxt("#page_delete_fail", "Echec de la suppression !");
////////////////////////////////////////////////////////END Delete Page /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Mail Register /////////////////////////////////////////////////////
$txtManager->AddTxt("#Object_Mail_register", "Confirmation de votre Mail");
$txtManager->AddTxt("#Echec_SendMail", "Echec de l'envoi du mail");
////////////////////////////////////////////////////////END Mail Register /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Modif Mails /////////////////////////////////////////////////////
$txtManager->AddTxt("#mail_modif_ok", "Mail modifié avec succès !");
$txtManager->AddTxt("#mail_crit_fail", "Impossible de modifier le mail, veuillez réessayer, si le problème persiste, contactez un Webmaster.");
////////////////////////////////////////////////////////END Modif Mails /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Add Mails /////////////////////////////////////////////////////
$txtManager->AddTxt("#add_mail_success", "mail ajoutée avec succès !");
$txtManager->AddTxt("#mail_NonInserted", "Echec de l'ajout du mail !");
$txtManager->AddTxt("#mail_not_empty", "Le sujet ou le contenu du mail n'est pas rempli.");
////////////////////////////////////////////////////////END Add Mails /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Delete Mails /////////////////////////////////////////////////////
$txtManager->AddTxt("#mail_delete_succes", "Mail supprimé avec succès ! ");
$txtManager->AddTxt("#mail_delete_fail", "Echec de la suppression !");
////////////////////////////////////////////////////////END Delete Mails /////////////////////////////////////////////////////
////////////////////////////////////////////////////////Reset password /////////////////////////////////////////////////////
$txtManager->AddTxt("#not_found_user","Le nom d'utilisateur ou l'adresse email est introuvable");
$txtManager->AddTxt("#mail_reset_send","Un email vous a été envoyé afin de procéder a la réinitialisation du mot de passe.");
$txtManager->AddTxt("#success_reset_pwd","Votre mot de passe a été modifié.");
$txtManager->AddTxt("#success_found_user","Un email vous a été envoyé afin de procéder à la réinitialisation du mot de passe");
/////////////////////////////////////////////////////// END RESET PASSWORD //////////////////////////////////////////////

?>