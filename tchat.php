<?php
include_once "controller/tchat_controller.php";
$dataMess = new Tchat_controller();
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
        
    </div>
    <?php if(isset($_SESSION['Connected']))
    { ?>
    <div class="container d-flex align-items-center">
        <div class="container mt-4 d-flex  justify-content-center align-items-center w-100">
            <form method="post" id="form-tchat" class="d-flex column w-75">
            <textarea id="content" class="d-flex justify-content-center align-items-center" wrap="hard" name="message" maxlength="255"></textarea>
            <p><span id="counterBlock"> </span> / 255 Characters</p>
            <input type="submit" class=" btn btn-info w-50 ml-auto mb-2" id="submitmsg" onclick="envoi(event)" value="Envoyer !" />
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
<script type="text/javascript">
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

function envoi(e) {
    e.preventDefault();
    let data = $("#form-tchat").serialize();
    $.ajax(
        {
            url: "/envoiTchat.php",
            method: "POST",
            data: data,
            success: function(data,textStatus,xhr)
            {
               refresh(data);
                //scrollbar tchat en bas
                element = document.getElementById('message');
                element.scrollTop = element.scrollHeight;
                $("#content").val("");
            },
            error: function(xhr,textStatus,error)
            {
                alert("error");
            }
        }
    );
    //  alert(data);
}

function refresh(data){
    
    $("#message").html(data)
}
function init() 
{
    setInterval(() => {
        $.ajax(
        {
            url: "/getChat.php",
            method: "GET",
            success: function(data,textStatus,xhr)
            {
               refresh(data);
                //scrollbar tchat en bas
                element = document.getElementById('message');
                element.scrollTop = element.scrollHeight;
            },
            error: function(xhr,textStatus,error)
            {
                alert("error");
            }
        }
    );
    }, 1000);
    }

$("#content").keypress(function (e) {
    if(e.which == 13)
    {
        if(!e.shiftKey) {        
            envoi(e);
        }
        else{
            // $("#content").val($("#content").val()+"\r\n");
        }
        // e.preventDefault();
    }
});
init();
</script>

