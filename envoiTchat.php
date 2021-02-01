<?php
include_once "controller/tchat_controller.php";
$dataMess = new Tchat_controller();

$message = stripslashes(trim(htmlspecialchars($_POST['message'])));
if(!empty($message))
{
$message = str_replace(chr(13).chr(10),"<br>",$message);
$dataMess->SendMessage($message);
}
echo $dataMess->messageHtml();
// array("\r\n", "\n", "\r");
?>