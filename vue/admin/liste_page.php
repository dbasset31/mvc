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

             if($data[0]=="#page_delete_succes" || $data[0]=="#page_delete_fail" || $data[0]=="#add_page_success" || $data[0]=="#page_NonInserted")
             {
               $msg = $data[0];
               $news = $data[1];
               
             }
             else
             {
               $news = $data;
              
             }
            $txtManager->DisplayText($msg);?>

            <div class="table-responsive">
                <table border="2" class="table table-dark table-hover" width="100%">
                <tr>
                    <th>ID</th>
                    <th>Url</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                </tr>
                <?php 
                    foreach ($news as $card)
                    { 
                ?>
                <tr>
                    <td ><?php echo $card->ID ?></td>
                    <td ><?php echo $card->url ?></td>
                    <td><?php echo $card->titre ?></td>
                    <td><?php echo $card->contenu ?></td>
                    <td><?php echo "<a href='/admin/edit_page/".$card->ID."'class='lien-nav'><i class='fas li_menu fa-pencil-alt'></i><span class='menu_e'>Modifier</span></a>" ?>
                    <td><?php echo "<a href='/admin/delete_page/".$card->ID."'class='lien-nav' onclick='AskDelete(".$card->ID.",event)'><i class='far li_menu fa-trash-alt'></i><span class='menu_e'>Supprimer</span></a>" ?>
                </tr>
                
                <?php 
                }
                ?>
                </table>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

  </div>
      <!-- End of Main Content -->

      <!-- Footer -->
     <?php include_once "vue/admin/footer.php" ?>
</body>
</html>
<script>
    function AskDelete(ID,event)
    {
        if (confirm("Êtes-vous sur de vouloir supprimer l\'ID : "+ID)) {
            return true;
        } else {
        event.preventDefault();
        }
    }
</script>
