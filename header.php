<?php
$data2 = new Header();
$menus = $data2->menu();
?>
<div class="container-fluid nav-bar d-flex align-content-center align-items-center justify-content-between lien-menu d-flex justify-content-around w-100">
            <img src="/vendor/img/logo-17.svg" />
<?php
    foreach ($menus as $menu)
    { 
        if($menu->permission == -1)
        {
            echo "            <a href='$menu->lien'>$menu->nom</a>";
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