<?php
include_once "config/bdd.php";
include_once "controller/controller.php";
include_once "Constants/Constants.php";
include_once "model/settings_model.php";
class Style 
{
    private $bdd;
    function __construct()
    {
        $this->bdd = new BDD();
    }
    function style()
    {
        
        $sqlStyle = "SELECT * FROM settings";
        $resultStyle = $this->bdd->Request($sqlStyle);
        $donneesStyle = $resultStyle->fetchALL();
        $objectsStyles = array();
        foreach ($donneesStyle as $objStyle)
        {
            array_push($objectsStyles, new Settings_model($objStyle));
        }
        return $objectsStyles;
    }
}
$dataStyle = new Style();
$styles = $dataStyle->style();
/////////////////////////////Start routeur /////////////////
$url = $_SERVER['REQUEST_URI'];
$testurl = explode("/", $url);
$methode = "index";
$controller = "news";
$args = "";
unset($testurl[0]);
if (count($testurl) >= 1){
    $controller = $testurl[1] == ""?"news" : $testurl[1];
    unset($testurl[1]);
    if (count($testurl) >= 1)
    {
        $methode = $testurl[2] == ""?"index" : $testurl[2];
        unset($testurl[2]);
        $args = implode(" , ",$testurl);
    }
}
else
{

    $controller = "news";
    $args= "";
}
$controller .= "_controller";
$controllerToCall = "controller/".$controller.".php";
if (file_exists ($controllerToCall))
{ 
    session_start();
    include_once $controllerToCall;
    $contollerObj = new $controller();
    
    if(method_exists($contollerObj,$methode))
    {
        $viewInfo = $contollerObj ->$methode($args);
        $vueDemandee = strtolower($viewInfo->viewName);
        $data = $viewInfo->data;
        include_once $vueDemandee;
    }
    else 
    {
        header('location: /error/perdu');
    }
}
else 
{
    header('location: /error/perdu');
}

?>

