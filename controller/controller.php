<?php
include_once "model/Utilisateur_model.php";
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
}

class ViewInfo {
    public $viewName;
    public $data;
    function __construct($vn, $d) {
        $this->viewName = $vn;
        $this->data = $d;
    }
}