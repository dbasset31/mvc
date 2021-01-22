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
            <div class = "container">
                <br />
                <div class="text-center">
                    <h2>Mon espace membre</h2>
                </div>
                <?php $date = date_create($data->naissance); ?>
                <div class="row d-flex justify-content-between">
                    <div class="col-md-6">
                        <p>Bienvenue dans votre compte <b><?php echo strtoupper($data->nom); echo " ".$data->prenom." !";?></b> Voici vos informations</p>
                        <p>Nom : <b><?php echo $data->nom;?></b></p>
                        <p>Prénom : <b><?php echo $data->prenom;?></b></p>
                        <p>Pseudo : <b><?php echo $data->pseudo;?></b></p>
                        <p>Sexe : <b><?php echo $data->sexe;?></b></p>
                        <p>Date de naissance : <b><?php echo date_format($date, "d M Y");?></b></p>
                        <p>Email : <b><?php echo $data->email;?></b></p>
                        <p>Vous êtes inscrit depuis le : <b><?php echo $data->inscription;?></b></p>
                        <p>info : <?php echo $data->info(); ?>
                    </div>
                    <div class="col-md-6 avatar-compte d-flex align-items-center justify-content-center">
                        <div class="column d-flex">
                        <img class="avatar-img" src="<?php echo $data->avatar ?>">
                        <a class = "btn btn-sm btn-success mt-2" href = "avatar"><i class = "glyphicon glyphicon-edit"></i> Modifier votre avatar</a>
                        </div>
                    </div>
                </div>
                <p>
                <a class = "btn btn-sm btn-success" href = "modifier"><i class = "glyphicon glyphicon-edit"></i> Modifier votre profil</a>
                <a class = "btn btn-sm btn-info" href = "logout"><i class = "glyphicon glyphicon-off"></i> Déconnexion</a>
                </p>
            </div>
        </main>
        <footer class="">
            <?php include_once "footer.php"; ?>
        </footer>
    </body>
 </html>