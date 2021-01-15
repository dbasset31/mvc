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
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><?php 
            var_dump($data);
              $msg = "";
              $user = $data;
              if (is_array($data))
              {
                $msg= $data[0];
                $user=$data[1];
              }
              if ($user->admin == false)
              $adm = 0;
              else 
                $adm =1;
            ?>
            <?php $txtManager->DisplayText($msg); ?>
            <form method="POST" action="/admin/edit_user/<?= $user->ID ?>">
            <label for="titre">ID :</label>
            <input type="text" name="id" value="<?= $user->ID ?>">
            
            <br>
            <label for="titre">nom utilisateur :</label>
            <input type="text" name="identifiant" value="<?= $user->identifiant ?>">

            <br>
            <label for="titre">email :</label>
            <input type="text" name="email" value="<?= $user->email ?>">
            
            <br>
            <label for="titre">pseudo :</label>
            <input type="text" name="pseudo" value="<?= $user->pseudo ?>">
            
            <br>
            <label for="titre">sexe :</label>
            <input type="text" name="sexe" value="<?= $user->sexe ?>">
            
            <br>
        
            <label for="titre">admin :</label>
            <input type="text" name="admin" value="<?= $adm ?>">
            
            <br>
            <label for="titre">nom :</label>
            <input type="text" name="nom" value="<?= $user->nom ?>">
            
            <br>
            <label for="titre">prenom :</label>
            <input type="text" name="prenom" value="<?= $user->prenom ?>">
            
            <br>

            <label for="titre">date de naissance :</label>
            <input type="text" name="naissance" value="<?= $user->naissance ?>">
            
            <br>

            <label for="titre">date d'inscription :</label>
            <input type="text" name="date_inscription" value="<?= $user->inscription ?>">
            
            <br>

            <label for="titre">avatar :</label>
            <input type="text" name="avatar" value="<?= $user->avatar ?>">
            
            <br>

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
