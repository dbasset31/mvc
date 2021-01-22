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
        </style>
<?php include_once "config/bdd.php";
include_once "model/Menu_model.php";

class Header 
{
    private $bdd;
    function __construct()
    {
        $this->bdd = new BDD();
    }
    function menu()
    {
        
        $sqlHead = "SELECT * FROM elements_menu";
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