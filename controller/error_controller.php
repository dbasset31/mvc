<?php
class Error_controller extends Controller{
    private $home_repo =null;
    function __construct(){
    }
    function perdu() {
        return $this->view();
    }
}