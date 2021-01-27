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
                    <div class="card pr-0 pl-0 mt-5 mb-5 col-lg-7 col-md-12 box">
                        <div class="w-100 card-header">
                            <h2>News</h2>
                        </div>
                        <?php 
                        foreach ($data[0] as $card)
                        { ?>
                        <div class="card-body">    
                            <div class="card text-white bg-dark mb-3 mt-3" style="max-width: 100%;">
                                <div class="card-header text-center"> 
                                    <h4><?php echo $card->titre ?></h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php echo $card->contenu ?></p>
                                </div>
                                <p class="d-flex justify-content-end date-news">Le : <?php echo $card->date."<br>"; ?></p>
                                <?php 
                                    if (isset($_SESSION['Connected']))
                                    {
                                        if ($_SESSION['Connected']->admin)
                                        {
                                            echo "<a href='/admin/edit_new/".$card->ID."' class='lien-nav'>modifier</a>" ; 
                                        }
                                    }
                                    else
                                    ?>
                            </div>
                        </div>
                        <?php }
                        if($data[4]==1){}
                        else 
                        {
                            echo "<div class='card-body'>";
                            for($i=1;$i<=$data[4]; $i++)
                            {
                                echo "<a class='anews' href='/news/index/$i'>$i</a>";
                            }
                            echo "</div>";
                            }?>
                    </div>
                    <div class="col-lg-3 col-md-12 mb-5">
                    <?php include "tchat.php"; ?>
                    </div>                      
                </div>                    
            </div>
        </main>

    <footer class="footer">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>