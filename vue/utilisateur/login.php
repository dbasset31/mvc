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
                      <h4 class="card-title text-center">Sign In</h4>
                      
                      <?php if($data == "#register_success" || $data=="#user_activate_succes" || $data=="#success_found_user" || $data=="#success_reset_pwd") { ?><p class="so_succ"><?php $txtManager->DisplayText($data)?></p>
                        <?php } else { ?><p class="so_fail"><?php $txtManager->DisplayText($data);};?></p>
                      <form class="form-signin" method="post" action="/utilisateur/login">
                        <div class="form-label-group">
                          <label for="inputEmail">Nom de compte :</label>
                          <input type="text" id="inputEmail" class="form-control" name="login" placeholder="Nom de compte" required autofocus>
                        </div>

                        <div class="form-label-group">
                          <label for="inputPassword">Mot de passe :</label>
                          <input type="password" id="inputPassword" class="form-control"  name="password" placeholder="Password" required>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                          <label class="custom-control-label" for="customCheck1">Se souvenir du mot de passe</label>
                        </div>
                        <div class="d-flex justify-content-center"><button style="color:#fff !important;" class="btn btn-info btn-block text-uppercase w-50 " type="submit">Connexion</button></div>
                        
                        <hr class="my-4">
                        <a href="/utilisateur/register">Pas de compte ? Cliquez ici pour vous inscrire.</a>
                        <hr class="my-1">
                        <a href="/utilisateur/resetpwd">Vous avez oublié votre mot de passe ? Cliquez ici pour le reinitialiser.</a>
                      </form>
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