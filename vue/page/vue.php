

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $data->titre; ?></title>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
        </header>
        <main class="container-fluid d-flex">
            <div>
                <h2><?php echo $data->titre; ?></h2>
            </div>
                <div class="container">
                    
                    </div>
                    <?php echo $data->contenu; ?>
                </div>
            </div>
        </main>
        <footer class="footer mt-2">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>