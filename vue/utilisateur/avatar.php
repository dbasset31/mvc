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
            <div class = "container">
                <br />
                <div class="text-center">
                    <h2>Modifier Avatar</h2>
                </div>
                <form action="/utilisateur/avatar" method="post" enctype="multipart/form-data">
                    <p>Selectionnez l'image à upload:</p>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Upload Image" name="submit">
                </form>
                <?php $txtManager->DisplayText($data);?>
            </div>
        </main>
        <footer class="">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
 </html>