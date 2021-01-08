
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
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
