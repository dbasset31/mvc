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

            <table border="1" width="100%">
              <tr>
                <th>ID</th>
                <th>Nom utilisateur</th>
              </tr>
              <?php 

                foreach ($user as $card)
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
<script>
    function AskDelete(id,event)
    {
        if (confirm("Êtes-vous sur de vouloir supprimer l\'ID : "+id)) {
            return true;
        } else {
        event.preventDefault();
        }
    }
</script>
</html>
