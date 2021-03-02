<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" Content-Security-Policy: default-src 'self';>
        <?php
            $url = explode('/', $_SERVER['REQUEST_URI']);
            if($_SERVER['REQUEST_URI'] == "/")
            {
                $url[2] = "Accueil";
            }
                
            if(isset($url[3]))
                $titre = ucfirst($url[3]);
            if(!isset($url[3])){
                if(isset($url[2]))
                    $titre = ucfirst($url[2]);
            }
            if(!isset($url[2])){
                $titre=ucfirst($url[1]);
            }
            if(isset($url[4])){
                $titre = ucfirst($url[4]);
            }
        ?>
        <title><?= $titre ?></title>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="/vendor/css/style.css">
        <style>
        <?php
        if(isset($styles[0])){?>
            h1{color:<?php echo $styles[0]->couleur_h1 ?> !important;}
            h2{color: <?php echo $styles[0]->couleur_h2 ?> !important;}
            h3{color:<?php echo $styles[0]->couleur_h3 ?> !important;}
            h4{color:<?php echo $styles[0]->couleur_h4 ?> !important;}
            .date-news{color:<?php echo $styles[0]->couleur_h4 ?> !important;}
            a{color: <?php echo $styles[0]->couleur_lien ?> !important;} 
            p{color: <?php echo $styles[0]->couleur_text ?> !important;}
            label{color: <?php echo $styles[0]->label ?> !important;}
            header{background-color: <?php echo $styles[0]->header_color ?> !important;}
            .bg-message{background-color: #DCDCDC;
            color : #212529 !important;}
            .tchat{max-height: 70vh;}
            #message{ overflow: auto;}
            footer{background-color: <?php echo $styles[0]->footer_color ?> !important}
            <?php }?>
        </style>
<?php 

include_once "config/bdd.php";
include_once "model/Menu_model.php";
include_once "model/Utilisateur_model.php";
include_once "repository/utilisateurs_repo.php";

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