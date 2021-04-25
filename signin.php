<?php
require 'bdd/DB.inc.php';
session_start();
$db = DB::getInstance();

if(isset($_POST['id']) AND isset($_POST['password'])){

    if($db->checkUserPass($_POST['id'],$_POST['password'])){
        $_SESSION['Client'] = $db->getUser($_POST['id']);
        $length = 32;
        $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
        if(isset($_GET['redirect'])) header('Location: '.$_GET['redirect']);
        else header('Location: index.php');
    }else{
        $errorPassword = true;
    }

}

function checkErrorPassword(){
    if($GLOBALS['errorPassword'])
        echo '<div class="alert alert-danger">Identifiant ou mot de passe incorrect</div>';
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <title>PromInfo Agenda</title>

    <style>

        @media (prefers-color-scheme: dark) {
            body {
                background: #141d26;
            }
            h1{
                color: white;
            }
        }
        @media (prefers-color-scheme: light) {
            body {
                background: #fff;
            }
            h1{
                color: black;
            }

        }

    </style>
</head>



<body class="text-center">

<form class="form-signin" method="POST" action="signin.php<?php if(isset($_GET['redirect'])) echo '?redirect='.$_GET['redirect'];?>">
    <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Merci de vous connecter</h1>
    <?php if(isset($_GET['error'])) echo '<div class="alert alert-danger">'.$_GET['error'].'</div>'; else checkErrorPassword();?>
    <label for="inputId" class="sr-only">Identifiant</label>
    <input type="text" name="id" id="inputId" class="form-control" placeholder="Identifiant" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
    <p class="mt-5 mb-3 text-muted">&copy; PromInfo 2019</p>
</form>

</body>

</html>
