<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include "head.php";?>
        <title>Modification du Profil</title>
    </head>
    <body>
        <header>
            <?php include_once "header.php";?>
            
        </header>
        <main>
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <div class = "pr-0 pl-0 mt-5 col-lg-7 col-md-7 mb-5 ">
                        <div class="ombre">
                            <div class="carte-head w-100">
                                <h2>Modification du Profil</h2>
                            </div>
                            <div class="carte d-flex column">
                                <div class="row">
                                    <div class="col-md-6 td d-flex align-items-center justify-content-center column">
                                        <form class="mt-5 justify-content-center w-100" method="POST" action="/utilisateur/modifier">
                                        <?php if ($data == "#pseudo_crit_fail" || $data == "#email_crit_fail" || $data == "#pseudo_exist" || $data == "#email_exist" || $data=="#Empty_field_modif" || $data=="#no_change") { echo "<p class='so_fail pb-5 text-center'> "; $txtManager->DisplayText($data); echo "</p>"; }?>
                                        <?php if ($data == "#pseudo_modif_ok" || $data == "#email_modif_ok" || $data == "#naissance_modif_ok" || $data == "#profil_edit_ok" ) { echo "<p class='so_succ pb-5 text-center'>"; $txtManager->DisplayText($data); echo "</p>"; }?>
                                        <div class="d-flex justify-content-center mb-2"> <label>Pseudonyme : </label>
                                            <input type="text" name="pseudo" class="ml-2" value="<?php echo $_SESSION['Connected']->pseudo;?>" required autofocus>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2"> 
                                            <label>Date de naissance : </label>
                                            <input type="date" name="naissance" class="ml-2" value="<?php echo $_SESSION['Connected']->naissance;?>" required autofocus>
                                        </div>
                                        <div class="d-flex justify-content-center"> 
                                            <label>Adresse email : </label>
                                            <input type="mail" name="email" class="ml-2" value="<?php echo $_SESSION['Connected']->email;?>" required autofocus>
                                        </div>
                                        <div class="d-inline-flex w-100 mb-5 justify-content-center"> 
                                                <a href="/utilisateur/compte" style="width: 25%;" class="mt-5 btn btn-lg btn-danger btn-block text-uppercase mr-2">Annuler</a>
                                                <button style="width: 25%;" class="mt-5 btn btn-lg btn-success btn-block text-uppercase ml-2" type="submit">Valider</button>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6  d-flex align-items-center justify-content-center">
                                        <form class="d-flex column mt-5" method="POST" action="/utilisateur/modifier">
                                        <?php if ( $data=="#Empty_field_pwd" || $data=="#no_change_pwd" || $data == "#pwd_fail" || $data == "#pwd_not_match") { echo "<p class='so_fail pb-5 text-center'> "; $txtManager->DisplayText($data); echo "</p>"; }?>
                                        <?php if ( $data =="#Pwd_success") { echo "<p class='so_succ pb-5 text-center'>"; $txtManager->DisplayText($data); echo "</p>"; }?>
                                            <div class="d-flex justify-content-center mb-2"> 
                                                <label>Mot de passe actuel : </label>
                                                <input type="password" class="ml-2" name="mdp" value="" required autofocus>
                                            </div>
                                            <div class="d-flex justify-content-center mb-2"> 
                                                <label>Nouveau mot de passe : </label>
                                                <input type="password" id="nmdp" class="ml-2" name="nmdp" value="" onkeyup="checkMdp()" required autofocus>
                                            </div>
                                            <div class="d-flex justify-content-center"> 
                                                <label>Confirmez mot de passe : </label>
                                                <input type="password" id="cnmdp" class="ml-2" name="cnmdp" value="" onkeyup="checkMdp()" required autofocus>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div id="mdpbox"></div>
                                            </div>
                                            <div class="d-inline-flex w-100 mb-5 justify-content-center mt-5"> 
                                                <button style="width: 35%;" class="mt-5 btn btn-lg btn-success btn-block text-uppercase ml-2" id ="submit" type="submit" disabled>Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-5 mb-0">
                        <?php include "tchat.php"; ?>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
    <script>
        function writedivmdp(texte)
        {
            document.getElementById('mdpbox').innerHTML = texte;
        }
    
        function checkMdp()
        {
            var mdp = document.getElementById("nmdp").value,//la virgule répercute le var sur la deuxième déclaration
            mdp2 = document.getElementById("cnmdp").value;//donc pas besoin de var ici
            var submit = document.getElementById("submit");
            if(mdp != "" && mdp2 !="")
            {
                if (mdp == mdp2)
                {
                    writedivmdp('<span style="color:#1A7917">Mots de passe OK !</span>');
                    submit.disabled = false; // on desactive
                }
                else
                {
                    writedivmdp('<span style="color:#cc0000">Les mots de passe ne correspondent pas !</span>');
                    submit.disabled = true;
                }
            }
            else if(mdp == "" || mdp2 == ""){writedivmdp(''); submit.disabled = true;}
        }
</script>
 </html>