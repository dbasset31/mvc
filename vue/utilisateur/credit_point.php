<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.php";?>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
            
        </header>
        <main>
            <div class="container-fluid row justify-content-around">
                <div class = "pr-0 pl-0 mt-5 col-lg-7 col-md-7 mb-5">
                    <div class="ombre">
                        <div class="carte-head w-100">
                            <h2>Cediter le compte</h2>
                        </div>
                        <?php
                        if(isset($data))
                        {
                            if(!is_array($data))
                            {
                                if($data == "#update_solde_fail")
                                {
                                    echo "<p class='so_fail'>";
                                    $txtManager->DisplayText($data); echo "</p>";
                                }
                            }
                            else {
                                if($data[1] == "#code_fail")
                                {
                                    echo "<p class='so_fail'>Le code : ".$data[0]."";
                                    $txtManager->DisplayText($data[1]); echo "</p>";
                                }
                                else {
                                    {
                                        echo "<p class='so_succ text-center pt-2 pt-md-1 pt-lg-5'> ";$txtManager->DisplayText($data[1]); echo $data[0]." €</p>";
                                    }
                                }
                            }
                            
                        }
                        ?>
                        <div class="carte">
                            <div id="starpass_441174"></div>
                            <script type="text/javascript" src="https://script.starpass.fr/script.php?idd=441174&amp;verif_en_php=1&amp;datas=" defer></script>
                            <noscript>
                                Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.
                                <br />
                                <a href="https://www.starpass.fr/">Micro Paiement StarPass</a>
                            </noscript>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 mb-0">
                    <?php include "tchat.php"; ?>
                </div>
            </div>
        </main>
        <footer class="footer">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
 </html>