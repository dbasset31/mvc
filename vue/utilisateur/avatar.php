<?php
	include_once 'header.php';
?>
<!DOCTYPE html>
 <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modifier Avatar</title>

        <!-- CSS de Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Notre style CSS -->
        <link href="bootstrap/css/style.css" rel="stylesheet">
    </head>
    <body>
        <main>
        <div class = "container">
            <br />
            <div class="text-center">
                <h2>Modifier Avatar</h2>
            </div>
            <form action="/utilisateur/avatar" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
<?php $txtManager->DisplayText($data);
phpinfo(); ?>

            <!-- Bibliothèque JavaScript jquery -->
            <script src="bootstrap/js/jquery.min.js"></script>
            
            <!-- JavaScript de Bootstrap -->
            <script src="bootstrap/js/bootstrap.min.js"></script>
        </main>
        <footer class="">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
 </html>