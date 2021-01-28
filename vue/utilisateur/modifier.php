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
        
            <div class="row justify-content-around">
                <div class = "pr-0 pl-0 mt-5 col-lg-7 col-md-12 mb-5 ">
                    <div class="ombre">
                        <div class="carte-head w-100">
                            <h2>Modification du Pseudo</h2>
                        </div>
                        <div class="carte pt-5 d-flex column align-items-center">
                            <?php if ($data == "#pseudo_crit_fail" || $data == "#pseudo_exist"){?>
                                <p class="so_fail pb-5 text-center"><?php $txtManager->DisplayText($data); }?></p>
                                <?php if ($data == "#pseudo_modif_ok"){?>
                                    <p class="so_succ pb-5 text-center"><?php $txtManager->DisplayText($data); }?></p>
                            <form method="POST" action="/utilisateur/modifier">
                               <div> <label>modifier votre pseudo : </label>
                                <input type="text" name="pseudo" value="<?php echo $_SESSION['Connected']->pseudo;?>">
                                </div>
                               <div class="d-inline-flex w-100"> 
                                    <a href="/utilisateur/compte" class=" mt-5 btn btn-lg btn-danger btn-block text-uppercase mr-2">Annuler</a>
                                    <button class="mt-5 btn btn-lg btn-success btn-block text-uppercase ml-2" type="submit">Valider</button>
                                </div>
                            </form>
                            <div class="w-100"><a href="/utilisateur/compte" class=" d-flex text-left">Retourner sur mon compte</a></div>
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