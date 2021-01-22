<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.php";?>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
            
        </header>
        <?php include_once "header.php";?>
        <!-- CSS de Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Notre style CSS -->
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <div class="container">
            <form method="POST" action="/utilisateur/modifier">
                <label>modifier votre pseudo : </label>
                <input type="text" name="pseudo" value="<?php echo $_SESSION['Connected']->pseudo;?>">
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Valider</button>
            </form>

            <?php $txtManager->DisplayText($data); ?>
            <a href="/utilisateur/compte">Retour...</a>
        </div>
        <footer>
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>
