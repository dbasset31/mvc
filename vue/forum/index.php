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
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="card mt-5 col-lg-9 col-md-12">
                        <div class="card-header">
                            <h2>Forum</h2>
                        </div>
                        <div class="card-body">
                        <?php 
                        var_dump($data);

                        foreach($data as $categorie)
                        {
                            echo $categorie->nom."</br>";
                            foreach($categorie->forums as $forum)
                            {
                                echo "&nbsp;-<a href='".strtolower(str_replace(" ","-",$forum->nom))."'>".$forum->nom."</a><br>";
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