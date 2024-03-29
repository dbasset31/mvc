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
            <?= $user->ID ?>
            
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
            <?php if($user->sexe == "Homme"){ ?>
                  <select name="sexe" id="Sexe-select" class="form-control w-25" required>
                    <option value="Homme"><?= $user->sexe ?></option>
                    <option value="Femme">Femme</option>
                  </select>
              <?php }
              else {
                ?>
                <select name="sexe" id="Sexe-select" class="form-control w-25" required>
                <option value="Femme"><?= $user->sexe ?></option>
                <option value="Homme">Homme</option>
              </select>
             <?php } ?>
            <br>
        
            <label for="titre">admin :</label>
            <?php if($adm == 0) echo "n'est pas administrateur"; else echo 'est administrateur'; ?>
            
            <br>
            <label for="titre">nom :</label>
            <input type="text" name="nom" value="<?= $user->nom ?>">
            
            <br>
            <label for="titre">prenom :</label>
            <input type="text" name="prenom" value="<?= $user->prenom ?>">
            
            <br>
            <?php $date = date_create($user->naissance); ?>
            <label for="titre">date de naissance :</label>
            <input type="text" name="naissance" value= '<?= date_format($date, "d M Y");?>'>
            
            <br>

            <label for="titre">date d'inscription :</label>
            <?= $user->inscription ?>
            
            <br>

            <label for="titre">avatar :</label>
            <img class="avatar-img" src='<?= $user->avatar ?>'/>
            
            <br>

            <button class="btn btn-lg btn-primary btn-block text-uppercase w-25 mt-5" type="submit">Valider</button>
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
