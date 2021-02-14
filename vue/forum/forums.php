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
                    <div class="mt-5 col-lg-9 col-md-9">
                        <div class="ombre mb-5">
                            <div class="w-100 carte-head mb-0">
                                <h2>Forum</h2>
                            </div>
                            <div class="d-flex column">
                                <?php
                                    $url = explode('/', $_SERVER['REQUEST_URI']);
                                if (!isset($url[3])){;
                                    foreach($data as $categorie)
                                    {
                                        echo "<div class='carte-head-forum'><h3>".$categorie->nom."</h3></div>";
                                        foreach($categorie->forums as $forum)
                                        {
                                            echo "<div class='mt-3'><a class='ml-4' href='/forum/forums/".strtolower(str_replace(" ","-",$forum->nom))."'>".$forum->nom."</a><hr class='mb-0'></div>";
                                        }
                                    }
                                }
                                if(isset($url[3]))
                                    if(!isset($url[4]) || empty($url[4])){
                                        $nom_forum=$data[1];
                                        foreach($data[0] as $topics)
                                        {
                                            echo "<div class='carte mt-3'><a class='ml-4' href='/forum/forums/".strtolower(str_replace(" ","-",$nom_forum))."/".str_replace(" ","-",$topics->titre_topic)."'>".$topics->titre_topic."</a> ".$topics->createur." ".$topics->vue." ".$topics->time."</div></br>";
                                            // "&nbsp;-<a href='/forum/forums/".strtolower(str_replace(" ","-",$forum->nom))."'>".$forum->nom."</a><br>";
                                            //  foreach($categorie->forums as $forum)
                                            //  {
                                            //     //  echo "&nbsp;-<a href='".strtolower(str_replace(" ","-",$forum->nom))."'>".$forum->nom."</a><br>";
                                            //  }
                                        }
                                }
                                if(!empty($url[4])){
                                    $forum_name = $data[1];
                                    $topic_name = $data[2];
                                    foreach($data[0] as $posts)
                                    {
                                        ?><h3><?php echo $posts->titre_post;?></h3>
                                        <div class="carte"><?php echo $posts->text_post; ?></div>
                                        <!-- echo $posts->titre_post."<br>".$posts->text_post."<br>".$posts->createur_post." ".$posts->date_poste."</br>"; -->
                                    <?php }
                                }

                                ?>
                            </div>
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