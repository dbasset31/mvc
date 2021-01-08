<div class="container-fluid nav-bar d-flex align-content-center align-items-center justify-content-between bg-dark lien-menu d-flex justify-content-around w-100">
            <img src="/vendor/img/logo-17.svg"></img>
            
                <a href="/news">Accueil</a>
                <?php if (!isset($_SESSION['Connected'])) 
                {
                    echo "<a href='/utilisateur/register'class='lien-nav' >Inscription</a>"; 
                    echo "<a href='/utilisateur/login' class='lien-nav'>Connexion</a>"; 
                }
                else 
                {
                    echo "<a href='/utilisateur/compte'class='lien-nav'>Mon compte </a>";
                    if ($_SESSION['Connected']->admin) echo "<a href='/admin'class='lien-nav'>Admin </a>" ;
                    echo "<a href='/utilisateur/logout'class='lien-nav'>Déconnexion </a>";
                }
                ?>
</div>