<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.php";?>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
            
        </header>
        <main>
          <?php include_once "header.php";?>
            <div class="container d-flex">
              <div class="row w-100">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto ">
                  <div class="card card-signin my-5 ">
                    <div class="card-body ombre align-items-center">
                      <h4 class="card-title text-center">Réinitialisation mot de passe</h4>
                      
                        <?php ?><p class="so_fail"><?php $txtManager->DisplayText($data);?></p>
                            <?php if (!isset($data) || $data != 'true' && $data != "#register_passwordDoesntMatch") {?>
                            <form class="form-signin" method="post" action="/utilisateur/resetpwd">
                                <div class="form-label-group">
                                <label for="inputEmail">Nom de compte ou adresse email :</label>
                                <input type="text" id="inputEmail" class="form-control mb-4" name="login" placeholder="Nom de compte ou adresse email" required autofocus>
                                <div class="d-flex justify-content-center"><button style="color:#fff !important;" class="btn btn-info btn-block text-uppercase w-50 " type="submit">Valider</button></div>
                            </form>
                            <?php } ?>
                            <?php if($data == 'true' || $data == '#register_passwordDoesntMatch'){
                              ?>
                              <form class="form-signin" method="post" action="/utilisateur/resetpwd">
                                <div class="form-label-group">
                                <label for="mdp">Nouveau mot de passe :</label>
                                <input type="password" id="mdp" class="form-control mb-4" name="mdp" placeholder="Saisissez un nouveau mot de passe" required autofocus>
                                <label for="cmdp">Confirmez votre nouveau mot de passe :</label>
                                <input type="password" id="cmdp" class="form-control mb-4" name="cmdp" placeholder="Confirmez votre nouveau mot de passe" required autofocus>
                                <div class="d-flex justify-content-center"><button style="color:#fff !important;" class="btn btn-info btn-block text-uppercase w-50 " type="submit">Valider</button></div>
                            </form>
                            <?php }
                            ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </main>
          <footer class="footer">
          <?php include_once "footer.php"; ?>
        </footer>
    </body>
</html>