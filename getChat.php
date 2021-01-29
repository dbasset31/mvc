<?php
include_once "controller/tchat_controller.php";
$dataMess = new Tchat_controller();
echo $dataMess->messageHtml();
?>