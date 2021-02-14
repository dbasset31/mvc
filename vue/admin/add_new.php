<!DOCTYPE html>
<html lang="en">
  <!-- Page Wrapper -->
  <div id="wrapper">
        <!-- End of Topbar -->
    <?php 
    $page = explode("/",$_SERVER['REQUEST_URI']);
    $page= $page[2];
    include_once "vue/admin/menu.php" ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div id="content">
            <!-- Page Heading -->
            
            <?php
            $page = $_SERVER['REQUEST_URI'];
             $txtManager->DisplayText($data); ?>
            <form method="POST" action="/admin/add_new/">
            <div class="container">
            <label for="titre" class="center">Titre:</label>
            
            <input type="text" name="titre" value="">
            
            <br>
            <label for="titre" class="mt-4">Contenu:</label>
            
            <textarea id="summernote" name="contenu"></textarea>
            
            <script>
      $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 400,
        // toolbar
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        ['view', ['fullscreen']],
        ['help', ['help']]
      ],
      });
    </script>

            

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

</html>
