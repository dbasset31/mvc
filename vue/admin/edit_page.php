<!DOCTYPE html>
<html lang="en">
  <!-- Page Wrapper -->
  <div id="wrapper">
        <!-- End of Topbar -->
    <?php include_once "vue/admin/menu.php" ?>
        <!-- Begin Page Content -->
        <?php 

              
              $msg = "";
              $page = $data;
              var_dump($page);
              if (is_array($data))
              {
                $msg= $data[0];
                $page=$data[1];
              }
      ?>
        <div class="container-fluid">
          <div id="content">
            <!-- Page Heading -->
            
            <?php $txtManager->DisplayText($msg); ?>
            <form method="POST" action="/admin/edit_page/<?= $page->ID ?>">
            <div class="container">
            <label for="titre" class="center">Titre:</label>
            <input type="text" name="titre" value="<?= $page->titre ?>">
            <br>
            <label for="url" class="center">Url:</label>

            <input type="text" name="url" value="<?= $page->url ?>">
            <br>
            <div>
            <label for="Connexion">Connexion requise</label>
            <?php if($page->connected == 0){?>
            <input type="checkbox" id="Connect" name="Connexion">
            <?php } else { ?><input type="checkbox" id="Connect" name="Connexion" checked><?php } ?>
            </div>

            <div>
            <label for="admin">Page accessible uniquement aux Admins</label>
            <?php if($page->admin == 0){?>
            <input type="checkbox" id="admin" name="admin">
            <?php } else { ?><input type="checkbox" id="admin" name="admin" checked><?php } ?>
            </div>
            <label for="titre">Contenu:</label>
            
            <textarea id="summernote" name="contenu"><?= $page->contenu ?></textarea>

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Valider</button>
            </div>
            </form>

            <?php  ?>

          </div>
        </div>
        <!-- /.container-fluid -->

  </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <?php include_once "vue/admin/footer.php" ?>
</body>
<script>
      $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 400
      });
    </script>
</html>
