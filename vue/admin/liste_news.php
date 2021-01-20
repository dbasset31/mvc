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
<<<<<<< HEAD

             if($data[0]=="#new_delete_succes" || $data[0]=="#new_delete_fail" || $data[0]=="#add_new_success" || $data[0]=="#news_NonInserted")
             {
               $msg = $data[0];
               $news = $data[1];
               
             }
             else
             {
               $news = $data;
              
             }
            $txtManager->DisplayText($msg);?>
=======
            if(count($data) == 2)
            {
              var_dump($data);
              $msg = $data[0];
              $news = $data[1];
            }
            else if(count($data) == 3)
            {
              var_dump($data);
                $msg = $data[0];
                $news = $data[1];
                $id = $data[2];
            }
            else
            {
              var_dump($data);
              $news = $data;
            }
            $txtManager->DisplayText($msg); echo $id;?>
>>>>>>> b97e55914e2360e4c9e804396466250f257ea425
            <table border="1" width="100%">
              <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Contenu</th>
              </tr>
              <?php 
                foreach ($news as $card)
                { 
              ?>
              <tr>
                <td><?php echo $card->ID ?></td>
                <td><?php echo $card->titre ?></td>
                <td><?php echo $card->contenu ?></td>
                <td><?php echo "<a href='/admin/edit_new/".$card->ID."'class='lien-nav'>modifier</a>" ?>
                <td><?php echo "<a href='/admin/delete_new/".$card->ID."'class='lien-nav' onclick='AskDelete(".$card->ID.",event)'>Supprimer</a>" ?>
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
