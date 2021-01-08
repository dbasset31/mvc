<?php
// affichage V ( View )
// require_once 'BDD/bdd.php'; 
// require_once 'BDD/requetes_affichage.php'; 

$currentPage = 'Test';

$titre = "Test";

$descritpion = "";

ob_start();

?>

<h1 class="w-100">Test</h1>

<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto saepe aspernatur ipsam totam, eaque excepturi numquam provident explicabo facilis deserunt obcaecati quo praesentium nam placeat accusantium eos repellendus sunt porro?</div>

<?php
// ob_get_clean
// stoppe la redirection du flux vers la memoire tampon
// recupere le contenu de la memoire tampon
// vide la memoire tampon
$main = ob_get_clean();
require_once 'gabarit.php';