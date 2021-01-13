<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
        </header>
        <main>
            <div class="container-fluid d-flex ">
                <div class="container">
                    <div class="card mt-5">    
                        <div class="card-header">Nouveautés</div>
                        <?php 
                        foreach ($data as $card)
                        { ?>
                    <div class="card-body">    
                            <div class="card text-white bg-dark mb-3 mt-3" style="max-width: 100%;">
                                <div class="card-header"> 
                                    <h4><?php echo $card->titre ?></h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $card->contenu ?></p>
                                </div>
                                <p class="d-flex justify-content-end">Le : <?php echo $card->date."<br>"; ?></p>
                                <?php 
                                if (isset($_SESSION['Connected']))
                                {
                                    if ($_SESSION['Connected']->admin)
                                    {
                                        echo "<a href='/admin/edit_new/".$card->ID."'class='lien-nav'>modifier</a>" ; 
                                    }
                                }
                                else
                                ?>
                            </div>
                        </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer mt-2">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>