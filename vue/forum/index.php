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

            <?php
            global $categ;
            global $forums;
            if(isset($data))
            {$forums=$data[1]; 
            $categ=$data[0];}var_dump($data);var_dump($forums);?>
            
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="card mt-5 col-lg-9 col-md-12">
                        <div class="card-header">
                            <h2>Forum</h2>
                        </div>
                        <div class="card-body">
                        <?php 
                        if(isset($forums))
                        {
                            foreach ($forums as $forum)
                            {
                                echo $forum->nom_cat;
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                    <?php include "tchat.php"; ?>
                    </div>                    
                </div>
            <div>
        </main>

    <footer class="footer">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>