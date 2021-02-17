<?php
class Test_controller extends Controller{
    function __construct(){
    }
    function index() {
        return $this->view();
    }
}