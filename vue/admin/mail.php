<!DOCTYPE html>
<html lang="en">

<body id="page-top">

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
            $msg = "";
            if(!empty($data)){
             if($data[0]=="#mail_delete_succes" || $data[0]=="#mail_delete_fail" || $data[0]=="#add_mail_success" || $data[0]=="#mail_NonInserted")
             {
               $msg = $data[0];
               $mail = $data[1];
               
             }
             else
             {
               $mail = $data;
              
             }
            }
            $txtManager->DisplayText($msg);?>
            <div class="table-responsive">
              <table border="1" width="100%" class="table table-hover table-dark">
                <tr>
                  <th >ID</th>
                  <th >fonction</th>
                  <th >Sujet</th>
                  <th >Contenu</th>
                </tr>
                <?php 
                if(isset($mail)){
                  foreach ($mail as $card)
                  { 
                ?>
                <tr>
                  <td ><?php echo $card->ID ?></td>
                  <td ><?php echo $card->fonction ?></td>
                  <td ><?php echo $card->sujet ?></td>
                  <td ><?php echo htmlspecialchars_decode($card->contenu) ?></td>
                  <td ><?php echo "<a href='/admin/edit_mail/".$card->ID."'class='lien-nav'><i class='fas li_menu fa-pencil-alt'></i><span class='menu_e'>Modifier</span></a>" ?>
                  <?php if($card->fonction != "register") echo "<td ><a href='/admin/delete_mail/ ".$card->ID."'class='lien-nav' onclick='AskDelete(".$card->ID.",event)'><i class='far li_menu fa-trash-alt'></i><span class='menu_e'>Supprimer</span></a>" ?>
                </tr>
              
                <?php 
                }
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
