<?php
//$indexToCall = "vue/".$controller."/".$methode.".php";
class Matteo_controller extends controller{
    function __construct(){
        
    }
    function index() {
        return $this->view();
    }