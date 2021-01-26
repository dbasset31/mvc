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
            <div class="card-header container ">
                <div class="bg-dark card-header">
                    <p><?php echo $message->autheur; ?> dit : </p>
                    <p class="d-flex bg-message justify-content-start card-body"><?php echo $message->message; ?></p>
                    <p class="d-flex justify-content-end"><?php echo "à : ".$message->date; ?></p>
                    
                </div>
            </div>
            <?php } ?>
    </div>
    <?php if(isset($_SESSION['Connected']))
    { ?>
    <div class="container">
        <div class="container mt-4 ">
            <form method="post" class=" d-flex  column">
            <textarea id="content" name="message" maxlength="255"></textarea>
            <p><span id="counterBlock"> </span> / 255 Characters</p>
            <input type="submit" class="w-50 ml-auto mb-2" value="Envoyer !" />
            </form>
        </div>
    </div>
    <?php }
    else 
    { ?>
        <div class="container">
        <div class="container mt-4 ">
            <form method="post" class=" d-flex  column">
            <textarea id="content" name="message" maxlength="255" placeholder="Vous devez être connecter pour poster un message !!""></textarea>
            <p><span id="counterBlock"> </span> / 255 Characters</p>
            </form>
        </div>
    </div>
    <?php } ?>
</div>
<script>
// On selectionne l'element textarea(id #content) et l'élement #counterBlock
var textarea = document.querySelector('#content');
var blockCount = document.getElementById('counterBlock');

function count() {
    // la fonction count calcule la longueur de la chaîne de caractère contenue dans le textarea
    var count = textarea.value.length;
    // et affche cette valeur dans la balise p#counterBlock grâce à innerHTML
    blockCount.innerHTML= count;
}
// on pose un écouteur d'évènement keyup sur le textarea.
// On déclenche la fonction count quand l'évènement se produit et au chargement de la page
textarea.addEventListener('keyup', count);
count();
</script>
  
