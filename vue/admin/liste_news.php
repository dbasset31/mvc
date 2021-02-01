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
            <div class="table-responsive">
              <table border="1" width="100%" class="table table-hover table-dark">
                <tr>
                  <th >ID</th>
                  <th >Titre</th>
                  <th >Contenu</th>
                </tr>
                <?php 
                  foreach ($news as $card)
                  { 
                ?>
                <tr>
                  <td ><?php echo $card->ID ?></td>
                  <td ><?php echo $card->titre ?></td>
                  <td ><?php echo $card->contenu ?></td>
                  <td ><?php echo "<a href='/admin/edit_new/".$card->ID."'class='lien-nav'><i class='fas li_menu fa-pencil-alt'></i><span class='menu_e'>Modifier</span></a>" ?>
                  <td ><?php echo "<a href='/admin/delete_new/".$card->ID."'class='lien-nav' onclick='AskDelete(".$card->ID.",event)'><i class='far li_menu fa-trash-alt'></i><span class='menu_e'>Supprimer</span></a>" ?>
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
    function AskDelete(id,event)
    {
        if (confirm("Êtes-vous sur de vouloir supprimer l\'ID : "+id)) {
            return true;
        } else {
        event.preventDefault();
        }
    }
</script>
