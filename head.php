<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="/vendor/css/style.css">
        <style>
            h1{color:<?php echo $styles[0]->couleur_h1 ?> !important;}
            h2{color: <?php echo $styles[0]->couleur_h2 ?> !important;}
            h3{color:<?php echo $styles[0]->couleur_h3 ?> !important;}
            h4{color:<?php echo $styles[0]->couleur_h4 ?> !important;}
            .date-news{color:<?php echo $styles[0]->couleur_h4 ?> !important;}
            a{color: <?php echo $styles[0]->couleur_lien ?> !important;} 
            p{color: <?php echo $styles[0]->couleur_text ?> !important;}
            label{color: <?php echo $styles[0]->label ?> !important;}
            header{background-color: <?php echo $styles[0]->header_color ?> !important;}
            .bg-message{background-color: rgba(83, 160, 39, 0.63);}
            .message{max-height: 50vh; overflow:scroll;}
        </style>
<?php 
include_once "config/bdd.php";
include_once "model/Menu_model.php";
include_once "model/Utilisateur_model.php";
include_once "model/Message_model.php";
include_once "repository/utilisateurs_repo.php";

class Tchat 
{
    private $bdd;
    function __construct()
    {
        $this->bdd = new BDD();
        $this->user_repo = new Utilisateur_repo();
    }
    function message()
    {
        
        $sqlMess = "SELECT * FROM message ORDER BY date ASC";
        $result = $this->bdd->Request($sqlMess);
        $donneesMess = $result->fetchALL();
        $objects = array();
        foreach ($donneesMess as $objMess)
        {
            array_push($objects, new Message_model($objMess));
        }
        return $objects;
    }

    function SendMessage($message)
    {
        $message = $this->bdd->secure($_POST['message']);
        $idUser = $_SESSION['Connected']->ID;
        $user = $this->user_repo->GetById($idUser);
        $InsertMess = "INSERT INTO message (autheur,message,date) VALUE(?,?,?)";
        $date = date("j/m/y H:i");
        $result = $this->bdd->Request($InsertMess,array($user->pseudo,$message,$date));
        $_POST['message'] = "";
        $message="";
        return $this->message();
    }
}
class Header 
{
    private $bdd;
    function __construct()
    {
        $this->bdd = new BDD();
    }
    function menu()
    {
        
        $sqlHead = "SELECT * FROM elements_menu ORDER BY ordre ASC";
        $result = $this->bdd->Request($sqlHead);
        $donnees = $result->fetchALL();
        $objects = array();
        foreach ($donnees as $obj)
        {
            array_push($objects, new Menu_model($obj));
        }
        return $objects;
    }
}
?>