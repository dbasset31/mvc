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
          <div class="container flex-grow-1">
            <div class="row">
              <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                  <div class="card-body">
                    <h4 class="card-title text-center">Sign In</h4>
                    <p class="error"><?php $txtManager->DisplayText($data); ?></p>
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
                      <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Connexion</button>
                      
                      <hr class="my-4">
                      <a href="/utilisateur/register">Pas de compte ? Cliquez ici pour vous inscrire.</a>
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