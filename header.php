<?php
include_once "config/bdd.php";
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
$data2 = new Header();
$menus = $data2->menu();
?>
<div class="container-fluid nav-bar d-flex align-content-center align-items-center justify-content-between bg-dark lien-menu d-flex justify-content-around w-100">
<img src="/vendor/img/logo-17.svg"></img>
<?php
    foreach ($menus as $menu)
    { 
        if($menu->permission == -1)
        {
            echo "<a href='$menu->lien'>$menu->nom</a>";
        }
        if(isset($_SESSION["Connected"]))
        {
            if($menu->permission == 1)
            {
                echo "<a href='$menu->lien'>$menu->nom</a>";
            }
            else
            if($_SESSION['Connected']->admin && $menu->permission >= 1)
            {
                echo "<a href='$menu->lien'>$menu->nom</a>";
            }
        }
        else 
            {
                if($menu->permission == 0)
                {
                    echo "<a href='$menu->lien'>$menu->nom</a>";
                }
            }
    } 
    

    ?>
</div>


