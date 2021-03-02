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
                        <h1><?php echo  $data->titre; ?></h1>
                        </div>
                        <div class="carte py-5 px-5 container">
                            <?php echo $data->contenu; ?>
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