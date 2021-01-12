<!DOCTYPE html>
<html lang="en">

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
        <!-- End of Topbar -->
    <?php include_once "vue/admin/menu.php" ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div id="content">
            <!-- Page Heading -->
            
            <?php $txtManager->DisplayText($data); ?>
            <form method="POST" action="/admin/add_new/">
            <label for="titre">Titre:</label>
            <input type="text" name="titre" value="">
            
            <br>
            <label for="titre">Contenu:</label>
            <textarea id="contenu" name="contenu"></textarea>
            

            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Valider</button>
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
