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
                            <h2>Modifier Avatar</h2>
                        </div>
                        <div class="carte p-5">
                            <?php if(isset($data)){
                                    if($data == "#avatar_modif_ok")
                                    { ?>
                                    <p class="so_succ"><?php $txtManager->DisplayText($data);
                                    }else 
                                    {?></p>
                                        <p class="so_fail"><?php $txtManager->DisplayText($data);}?></p>
                                        <?php 
                            }?>
                            <form action="/utilisateur/avatar" method="post" enctype="multipart/form-data">
                                <p>Selectionnez l'image à upload:</p>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload Image" name="submit">
                            </form>
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