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
?>
<?php
$url = $_SERVER['REQUEST_URI'];
$testurl = explode("/", $url);
$methode = "index";
$controller = "home";
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
    $home = new $controller();
    
    if(method_exists($home,$methode))
    {
       
        $viewInfo = $home ->$methode($args);
        
        $vueDemandee = $viewInfo->viewName; 
        if (file_exists($vueDemandee))
        {
            $data = $viewInfo->data;
            include_once $vueDemandee;
        }
        else {
            echo "eh bah la vue elle existe pas d'abord !";
        }
    }
    else 
    {
        echo "la méthode : ".$methode." n'éxiste pas";
    }
    
}
else 
{
    echo "non";
}

?>

