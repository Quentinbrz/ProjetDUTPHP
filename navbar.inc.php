<?php ?>

<style>

    @media (max-width: 768px) {
        .navbar .navbar-nav {
            float: none;
            vertical-align: top;
        }

        .navbar .navbar-collapse {
            text-align: center;
        }

    }

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="/PromInfo/bootstrap/js/bootstrap.js"></script>


<header>

    <nav class="navbar navbar-expand-sm navbar-dark official-bg">
        <!--<a class="navbar-brand" href="index.php">
            <img src="img/Icon-Nav.png" width="50" height="55" class="d-inline-block align-top" alt="Icône">
        </a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link <?php if(basename($_SERVER['PHP_SELF']) == "index.php") echo "active"; ?>" href="/PromInfo/index.php">Accueil <span class="sr-only">(current)</span></a>
                <?php if(in_array(1,$db->getRoles($_SESSION['Client']->getKeyUser()))){
                    $isActive = "active";
                    if(basename($_SERVER['PHP_SELF']) != "settings.php") $isActive = "";
                    echo '<a class="nav-item nav-link '.$isActive.'" href="/PromInfo/settings/settings.php">Paramètres <span class="sr-only">(current)</span></a>';
                }else echo '<a class="nav-item nav-link '.$isActive.'" href="/PromInfo/passChangeUser.php">Changer de mot de passe <span class="sr-only">(current)</span></a>';?>
            </div>
            <a class="btn btn-danger my-2 my-sm-0" href="/PromInfo/disconnect.php">Déconnexion</a>
        </div>
    </nav>

</header>