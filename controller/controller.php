<?php
include_once "model/Utilisateur_model.php";
// path du dossier PHPMailer % fichier d'envoi du mail
require 'config/PHPMailer/src/Exception.php';
require 'config/PHPMailer/src/PHPMailer.php';
require 'config/PHPMailer/src/SMTP.php';
// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Controller {
    
    protected function view($args=null){
        $viewName = debug_backtrace()[1]['function'];
        $controller = str_replace("_controller", "", debug_backtrace()[1]['class']);
        return new ViewInfo("vue/".$controller."/".$viewName.".php",$args);
    }

    protected function otherViewAndController($controller, $viewName,$args=null){
        return new ViewInfo("vue/".$controller."/".$viewName.".php",$args);
    }

    ///
    // Permet de retourner une vue passée en paramètre
    // $viewname : string
    // $args : object
    ///
    protected function otherView($viewName,$args=null){
        $controller = str_replace("_controller", "", debug_backtrace()[1]['class']);
        return new ViewInfo("vue/".$controller."/".$viewName.".php",$args);
    }

    protected function CheckAdmin()
    {
        if (isset($_SESSION['Connected']))
        {
            if (!$_SESSION['Connected']->admin)
                header('Location: /error/perdu');
        }
        else
        {
            header('Location: /error/perdu');
        }
    }

    protected function CheckConnect()
    {
        if (!isset($_SESSION['Connected']))
        {
                header('Location: /utilisateur/login');
        }
    }
    function token32()
        {
            return sprintf('%04X%04X%04X%04X%04X%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));    
        }

     function siteURL()
        {
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domainName = $_SERVER['HTTP_HOST'];
            return $protocol.$domainName;
        }

     function sendMail($email,$objet,$contenu)
        {
            global $txtManager;
            // on crée une nouvelle instance de la classe
            $mail = new PHPMailer(true);
            // puis on l’exécute avec un 'try/catch' qui teste les erreurs d'envoi
            try {
            /* DONNEES SERVEUR */
            #####################
            $mail->setLanguage('fr', 'config/PHPMailer/language/');   // pour avoir les messages d'erreur en FR
            $mail->SMTPDebug = 2;            // en production (sinon "2")
            // $mail->SMTPDebug = 2;            // décommenter en mode débug
            $mail->isSMTP();                                                            // envoi avec le SMTP du serveur
            $mail->Host       = 'dns01.topheberge.fr';                            // serveur SMTP
            $mail->SMTPAuth   = true;                                            // le serveur SMTP nécessite une authentification ("false" sinon)
            $mail->Username   = 'Contact@donovan-basset.cf';     // login SMTP
            $mail->Password   = 'Darkmoi260316!';                                                // Mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     // encodage des données TLS (ou juste 'tls') > "Aucun chiffrement des données"; sinon PHPMailer::ENCRYPTION_SMTPS (ou juste 'ssl')
            $mail->Port       = 465;                                                               // port TCP (ou 25, ou 465...)

            /* DONNEES DESTINATAIRES */
            ##########################
            $mail->setFrom('Contact@donovan-basset.cf', 'Contact TopHeberge');  //adresse de l'expéditeur (pas d'accents)
            $mail->addAddress($email);        // Adresse du destinataire (le nom est facultatif)
            // $mail->addReplyTo('moi@mon_domaine.fr', 'son nom');     // réponse à un autre que l'expéditeur (le nom est facultatif)
            // $mail->addCC('cc@example.com');            // Cc (copie) : autant d'adresse que souhaité = Cc (le nom est facultatif)
            // $mail->addBCC('bcc@example.com');          // Cci (Copie cachée) :  : autant d'adresse que souhaité = Cci (le nom est facultatif)

            /* PIECES JOINTES */
            ##########################
            // $mail->addAttachment('../dossier/fichier.zip');         // Pièces jointes en gardant le nom du fichier sur le serveur
            // $mail->addAttachment('../dossier/fichier.zip', 'nouveau_nom.zip');    // Ou : pièce jointe + nouveau nom

            /* CONTENU DE L'EMAIL*/
            ##########################
            $mail->isHTML(true);                                      // email au format HTML
            $mail->Subject = utf8_decode($objet);      // Objet du message (éviter les accents là, sauf si utf8_encode)
            $mail->Body    = utf8_decode($contenu);          // corps du message en HTML - Mettre des slashes si apostrophes
            $mail->AltBody = utf8_decode($contenu); // ajout facultatif de texte sans balises HTML (format texte)
            $mail->AddCustomHeader("List-Unsubscribe: <mailto:Contact@donovan-basset.cf/Unsubscribe>, <https://donovan-basset.cf/Unsubscribe/mailid=1234>");
            $mail->send();
            return "#Mail_send";

            }
            // si le try ne marche pas > exception ici
            catch (Exception $e) {
                return "{$mail->ErrorInfo}"; // Affiche l'erreur concernée le cas échéant
            }   // fin de la fonction sendmail
        }
}

class ViewInfo {
    public $viewName;
    public $data;
    function __construct($vn, $d) {
        $this->viewName = $vn;
        $this->data = $d;
    }
}