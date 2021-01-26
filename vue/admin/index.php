<!DOCTYPE html>
<html>
<div id="wrapper">
<?php include_once "vue/admin/menu.php" ?>
<body id="page-top">
  <!-- Page Wrapper -->
  
    
      <!-- Begin Page Content -->
      <div class="container-fluid">
      <h1>Admin Panel</h1>
        <h2>Configuration Générale</h2>
        <h3>c'est un h3</h3>
        <h4>C'est un h4</h4>
        <div class="row">
          <div id="content" class="col-md-3">
            <form method="POST" action="/admin">
              <fieldset class="border p-2">
                <legend  class="w-auto">News</legend>
                <label>Nombre de News sur la page d'accueil :</label>
                <p><input name="nbNews" value="<?php echo $data[1]->nbNews; ?>"></p>
                <button type="submit">Valider</button>
              </fieldset>
            </form>
            </div>
            <div id="content" class="col-md-8">
              
                <form method="POST" action="/admin">
                  <fieldset class="border p-2">
                    <legend  class="w-auto">Couleurs</legend>
                    <div class="row">
                      <div class="col-md-6">
                      <label>Couleur des titres H1 : </label>
                      <input type="color" id="h1" name="h1" value="<?php echo $data[1]->couleur_h1; ?>">
                      <label>Couleur des titres H2 :</label>
                      <input type="color" id="h2" name="h2" value="<?php echo $data[1]->couleur_h2; ?>">
                      <label>Couleur des titres H3 :</label>
                      <input type="color" id="h3" name="h3" value="<?php echo $data[1]->couleur_h3; ?>">
                      <label>Couleur des titres H4 :</label>
                      <input type="color" id="h4" name="h4" value="<?php echo $data[1]->couleur_h4; ?>">
                      </div>
                      <div class="col-md-6">
                      <label>Couleur des liens :</label>
                      <input type="color" id="lien" name="lien" value="<?php echo $data[1]->couleur_lien; ?>">
                      <label>Couleur des paragraphes :</label>
                      <input type="color" id="text" name="text" value="<?php echo $data[1]->couleur_text; ?>">
                      <label>Couleur des labels :</label>
                      <input type="color" id="label" name="label" value="<?php echo $data[1]->label; ?>"><br>
                      <label>Couleur du header :</label>
                      <input type="color" id="header_color" name="header_color" value="<?php echo $data[1]->header_color; ?>">
                      <label>Couleur du footer :</label>
                      <input type="color" id="footer_color" name="footer_color" value="<?php echo $data[1]->footer_color; ?>">
                      </div>
                    </div>
                    <button type="submit" >Valider</button>
                  </fieldset>
                </form>
              
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
     <?php include_once "vue/admin/footer.php" ?>
  </div>
</body>
</html>
