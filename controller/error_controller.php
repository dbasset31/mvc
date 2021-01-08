<?php
class Error_controller extends controller{
    private $home_repo =null;
    function __construct(){
    }
    function perdu() {
        return $this->view();
    }
}