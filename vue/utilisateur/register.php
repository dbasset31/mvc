<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<?php include_once "header.php";?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body text-center">
            <h5 class="card-title text-center">Register</h5>
            <p class="error w-100"><?php $txtManager->DisplayText($data); ?></p>
            <form class="form-register" method="post" action="/utilisateur/register">
              <div class="form-label-group">
              <label for="inputEmail">Nom de compte</label>
                <input type="text" id="inputEmail" class="form-control" name="login" placeholder="Nom de compte" required autofocus>
                
              </div>

              <div class="form-label-group">
              <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control"  name="password" placeholder="Mot de passe" required autofocus>
                
              </div>
              <div class="form-label-group">
                <label for="inputPassword">Confirmez votre Password</label>
                <input type="password" id="inputPassword" class="form-control"  name="conf_password" placeholder="Confirmez votre mot de passe" required autofocus>
                <p></p>
              </div>

              <div class="form-label-group">
              <label for="inputEmail">Adresse E-mail</label>
                <input type="mail" class="form-control" name="email" placeholder="entre votre adresse mail..." required autofocus>
                
              </div>

              <div class="form-label-group">
              <label for="inputEmail">Pseudo</label>
                <input type="text" class="form-control" name="pseudo" placeholder="entre un pseudonyme..." required autofocus>
                
              </div>

              <div class="form-label-group">
              <label for="inputEmail">Nom</label>
                <input type="text" class="form-control"  name="nom" placeholder="Entrez votre nom..." required autofocus>
                
              </div>
              <div class="form-label-group">
              <label for="inputEmail">Prénom</label>
                <input type="text"  class="form-control"  name="prenom" placeholder="Entrez votre prénom..." required autofocus>
                
              </div>
              <div class="form-label-group">
              <label for="inputEmail">Date de naissance</label>
                <input type="date"  class="form-control"  name="naissance" placeholder="01/01/1990" required autofocus>
              </div>

              <div class="form-label-group">
              <label for="pet-select">Choisissez votre sexe :</label><br>
              <select name="sexe" id="Sexe-select" form-control required>
              <option value="">--Veuillez selectionner votre sexe--</option>
              <option value="Homme">Homme</option>
              <option value="Femme">Femme</option>
              </select>
              </div>
              <br>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Inscription</button>
              <hr class="my-4">
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

