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
            <table border="1" width="100%">
              <tr>
                <th>ID</th>
                <th>Nom utilisateur</th>
              </tr>
              <?php 
                foreach ($data as $card)
                { 
              ?>
              <tr>
                <td><?php echo $card->ID ?></td>
                <td><?php echo $card->identifiant ?></td>
              </tr>
            
              <?php 
              }
              ?>
              </table>
          </div>
        </div>
        <!-- /.container-fluid -->

  </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <?php include_once "vue/admin/footer.php" ?>
</body>

</html>
