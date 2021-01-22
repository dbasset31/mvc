<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.php";?>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
            
        </header>
        <main class="container-fluid d-flex">
            <div class="container">
                <h2><?php echo $data->titre; ?></h2>
                <?php echo $data->contenu; ?>
            </div>
        </main>
        <footer class="footer mt-2">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>