<?php
$dataMess = new Tchat();
$Mess = $dataMess->message();
if(isset($_POST["message"]) && !empty($_POST["message"]))
{
    $dataMess->SendMessage($_POST['message']);
}
?>

<div class="card mt-5 tchat ombre">    
    <div class="card-header">
        <h2>TchatBox</h2>
    </div>
    <div id="message">
        <?php foreach ($Mess as $message) { ?>
            <div class="carte-head container ">
                <div class="bg-dark carte-head p-0">
                    <p><?php echo $message->autheur; ?> dit : </p>
                    <p class="d-flex bg-message justify-content-start w-100 flex-wrap carte-mess" style=""><?php echo $message->message; ?></p>
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
            <textarea id="content" wrap="hard" cols="32" name="message" maxlength="255"></textarea>
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
            <textarea id="content" name="message" maxlength="255" placeholder="Vous devez être connecter pour poster un message !!" disabled></textarea>
            <p><span id="counterBlock"> </span> / 255 Characters</p>
            </form>
        </div>
    </div>
    <?php } ?>
</div>
<script>
// selection de l'element textarea(id #content) et l'élement #counterBlock
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

//scrollbar tchat en bas
element = document.getElementById('message');
element.scrollTop = element.scrollHeight;
</script>

