<?php
$dataMess = new Tchat();
$Mess = $dataMess->message();
if(isset($_POST["message"]) && !empty($_POST["message"]))
{
    $dataMess->SendMessage($_POST['message']);
}
?>

<div class="card mt-5">    
    <div class="card-header">
        <h2>TchatBox</h2>
    </div>
    <div class="message">
        <?php foreach ($Mess as $message) { ?>
            <div class="card-body container ">
                <div class="bg-dark">
                <p><?php echo $message->autheur; ?> dit : </p>
                <p class="d-flex bg-message justify-content-start"><?php echo $message->message; ?></p>
                <p class="d-flex justify-content-end"><?php echo "à : ".$message->date; ?></p>
                <hr>
                </div>
            </div>
            <?php } ?>
    </div>
        <div>
            <form method="post">
            <textarea name="message"></textarea>
            <input type="submit" value="Evoyer !" />
            </form>
        </div>
    
</div>
  
