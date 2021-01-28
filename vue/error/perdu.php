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
                            <h2>Page Introuvable</h2>
                        </div>
                        <div class="carte">
                        <p class="so_fail">La page &quot<?php echo $data ?>&quot est introuvable ou a été suprimée.</p>
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