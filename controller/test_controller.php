<?php
class Test_controller extends controller{
    function __construct(){
    }
    function index() {
        return $this->view();
    }
}