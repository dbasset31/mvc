<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<?php include_once "header.php";?>
<body>
  <div class="container flex-grow-1">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
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
  <footer class="">
    <?php include_once "footer.php"; ?>
  </footer>
</body>