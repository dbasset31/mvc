<!DOCTYPE html>
<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
        <!-- End of Topbar -->
    <?php include_once "vue/admin/menu.php" ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div id="content">
            <!-- Page Heading -->
            <?php 

              
              $msg = "";
              $news = $data;
              if (is_array($data))
              {
                $msg= $data[0];
                $news=$data[1];
              }
                                          
      ?>
    
            <?php $txtManager->DisplayText($msg); ?>
            <form method="POST" action="/admin/edit_new/<?= $news->ID ?>">
            <label for="titre">Titre:</label>
            <input type="text" name="titre" value="<?= $news->titre ?>">
            
            <br>
            <label for="titre">Contenu:</label>
            <textarea id="summernote" name="contenu"><?= $news->contenu ?></textarea>
            <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>
            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Valider</button>
            </form>

  
          </div>
        </div>
        <!-- /.container-fluid -->

  </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <?php include_once "vue/admin/footer.php" ?>
</body>

</html>
