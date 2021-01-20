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
<<<<<<< HEAD
<<<<<<< HEAD
            <?php
            $msg = "";

             if($data[0]=="#user_delete_succes")
             {
              $msg = $data[0];
              $user = $data[1];
            }
            else
            {
              $user = $data;
            }
            $txtManager->DisplayText($msg);?>
=======
=======
>>>>>>> b97e55914e2360e4c9e804396466250f257ea425

            
             <?php 
              $news = $data[1];
           ?>
<<<<<<< HEAD
>>>>>>> b97e55914e2360e4c9e804396466250f257ea425
=======
>>>>>>> b97e55914e2360e4c9e804396466250f257ea425
            <table border="1" width="100%">
              <tr>
                <th>ID</th>
                <th>Nom utilisateur</th>
              </tr>
              <?php 
<<<<<<< HEAD
<<<<<<< HEAD
                foreach ($user as $card)
=======
            
                foreach ($news as $card)
>>>>>>> b97e55914e2360e4c9e804396466250f257ea425
=======
            
                foreach ($news as $card)
>>>>>>> b97e55914e2360e4c9e804396466250f257ea425
                { 
              ?>
              <tr>
              
                <td><?php echo $card->ID ?></td>
                <td><?php echo $card->identifiant ?></td>
                <td><?php echo "<a href='/admin/edit_user/".$card->ID."'>Modifier</a>"?></td>
                <td><?php echo "<a href='/admin/delete_user/".$card->ID."' onclick='AskDelete(".$card->ID.",event)'>Supprimer</a>"?></td>
              </tr>
            
              <?php 
              }
              var_dump($data);
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
