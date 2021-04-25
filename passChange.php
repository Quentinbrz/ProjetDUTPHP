<?php
require 'bdd/DB.inc.php';
session_start();
$db = DB::getInstance();
if(!isset($_SESSION['Client'])) header('Location: signin.php');
if(isset($_POST['password']) AND isset($_POST['passwordVerify'])){

    if(($_POST['password'] == $_POST['passwordVerify']) && checkPassCondition($_POST['password'])){
        $db->changePassHash($_SESSION['Client']->getKeyUser(),password_hash($_POST['password'],PASSWORD_DEFAULT),'0');
        header('Location: index.php');
    }else{
        $errorPassword = true;
    }
}

function checkPassCondition($pass){

    if(strlen($pass) < 8) return false;
    $upper = 0;
    $lower = 0;
    $others = 0;
    for ($i = 0; $i < strlen($pass); $i++)
    {
        if ($pass[$i] >= 'A' &&  $pass[$i] <= 'Z') $upper++;
        else if ($pass[$i] >= 'a' && $pass[$i] <= 'z') $lower++;
        else $others++;
    }
    if($upper < 2 OR $lower < 2 OR $others < 2) return false;
    return true;
}

function checkErrorPassword(){
    if($GLOBALS['errorPassword'])
        echo '<div class="alert alert-danger">Le mot de passe doit faire 8 caractère, au moins 2 majuscule, 2 minuscule et 2 caractère non alphabétique</div>';
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

</head>

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

<body class="text-center">

<form class="form-signin" method="POST" action="passChange.php">
    <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Il semblerait que c'est votre première connexion, il vous faut un nouveau mot de passe</h1>
    <?php checkErrorPassword();?>
    <label for="inputPassword" class="sr-only">Mot de passe</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required autofocus>
    <label for="inputPasswordVerify" class="sr-only">Confirmation du mot de passe</label>
    <input type="password" name="passwordVerify" id="inputPasswordVerify" class="form-control" placeholder="Confirmation du mot de passe" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
    <p class="mt-5 mb-3 text-muted">&copy; PromInfo 2019</p>
</form>

</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="scripts/passChange.js"></script>

</html>

