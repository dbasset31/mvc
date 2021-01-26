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
            <?php
            $items = $data; ?>
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class="card pr-0 pl-0 mt-5 mb-5 col-lg-7 col-md-12">
                        <div class="container-fluid w-100 card-header">
                            <h2>Boutique</h2>
                        </div>
                        <div class="card-body">
                        <table border="1" width="100%">

              <tr>
                <th>Nom</th>
                <th>Prix</th>
              </tr>
              <?php 
                foreach ($items as $item)
                { 
              ?>
              <tr>
                <td><?php echo $item->nom ?></td>
                <td><?php echo $item->prix ?></td>
                <td><a href="#"><i class="fas fa-cart-plus"></i></a>
                
              </tr>
            
              <?php 
              }
              ?>
              </table>
                    </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-12">
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