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
            <div class = "container">
                <br />
                <div class="text-center">
                    <h2>Crediter le compte</h2>
                </div>
                <?php
                    if(isset($data))
                    {
                        if(!is_array($data))
                        {
                            if($data == "#update_solde_fail")
                            {
                                $txtManager->DisplayText($data);
                            }
                        }
                        else {
                            if($data[1] == "#code_fail")
                            {
                                echo "<p class='error'>Le code : ".$data[0]."";
                                $txtManager->DisplayText($data[1]); echo "</p>";
                            }
                            else {
                                {
                                    $txtManager->DisplayText($data[1]); echo $data[0]." €";
                                }
                            }
                        }
                        
                    }
                ?>
                <div id="starpass_441174"></div>
                    <script type="text/javascript" src="https://script.starpass.fr/script.php?idd=441174&amp;verif_en_php=1&amp;datas="></script>
                    <noscript>
                        Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.
                        <br />
                        <a href="https://www.starpass.fr/">Micro Paiement StarPass</a>
                    </noscript>
                </div>
            </div>
        </main>
        <footer class="">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>
