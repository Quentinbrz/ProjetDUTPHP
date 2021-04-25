<?php
require 'checkConnection.inc.php';
function getYear($month){
    if($month > 8){
        if (date('m') > 8) echo date('Y'); else echo date('Y') - 1;
    }else{
        if (date('m') < 7) echo date('Y'); else echo date('Y') + 1;
    }
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
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>PromInfo Cahier de Texte</title>
</head>

<body>
<?php include "navbar.inc.php";?>

<main>
    <div class="container">
        <?php include 'modals/seance/modalAddSeance.inc.php';?>
        <?php include 'modals/seance/modalDeleteSeance.inc.php';?>
        <?php include 'modals/seance/modalFilterSeance.php';?>
        <?php include 'modals/event/modalAddEvent.inc.php';?>
        <?php include 'modals/event/modalDeleteEvent.inc.php';?>
        <?php include 'modals/event/modalEditEvent.inc.php';?>
    </div>

</main>

<style>

    @media (prefers-color-scheme: dark) {
        .modal-content {
            background: #141d26;
        }
        .card-header{
            background: #141d26;
        }
        .card-body{
            background: #141d26;
        }
        .darkModeInput{
            background: #141d26;
            color : white;
        }
        .darkModeInput:focus{
            background: #141d26;
            color : white;
        }
        .darkModeText{
            color: white;
        }
        body {
            background: #141d26;
        }
        th{
            color : white;
        }
        td{
            color : white;
        }
        label{
            color: white;
        }
        h5{
            color: white;
        }
        .attachmentIcon{
            background-color: white;
        }
    }
    @media (prefers-color-scheme: light) {
        body {
            background: #fff;
        }
        h1{
            color: black;
        }
        .darkModeText{
            color: black;
        }

    }

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-10 table-responsive" style="padding: 0; margin-bottom: 0;">
            <table class="table table-bordered" style="margin-bottom: 0;">
                <tr class="official-bg" style="color: white; font-weight: bold; font-size: 2.5rem; text-align: center;">
                    <td colspan="4"><?php if(date('m') < 7) echo date('Y')-1; else echo date('Y');?></td>
                    <td colspan="6"><?php if(date('m') < 7) echo date('Y'); else echo date('Y')+1;?></td>
                </tr>
                <tr class="tab-mois">
                    <?php $mois = isset($_GET['mois']) && !empty($_GET['mois']) ? $_GET['mois'] : date('m'); ?>
                    <td <?php if($mois == 9) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=09&annee=<?php echo getYear(9);?>"> Septembre </a></td>
                    <td <?php if($mois == 10) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=10&annee=<?php echo getYear(10);?>"> Octobre </a></td>
                    <td <?php if($mois == 11) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=11&annee=<?php echo getYear(11);?>"> Novembre </a></td>
                    <td <?php if($mois == 12) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=12&annee=<?php echo getYear(12);?>"> Decembre </a></td>
                    <td <?php if($mois == 1) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=01&annee=<?php echo getYear(1);?>"> Janvier </a></td>
                    <td <?php if($mois == 2) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=02&annee=<?php echo getYear(2);?>"> Février </a></td>
                    <td <?php if($mois == 3) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=03&annee=<?php echo getYear(3);?>"> Mars </a></td>
                    <td <?php if($mois == 4) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=04&annee=<?php echo getYear(4);?>"> Avril </a></td>
                    <td <?php if($mois == 5) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=05&annee=<?php echo getYear(5);?>"> Mai </a></td>
                    <td <?php if($mois == 6) echo 'class="prominfo-active"'; ?>> <a class="darkModeText" href="?mois=06&annee=<?php echo getYear(6);?>"> Juin </a></td>
                </tr>
            </table>
        </div>
        <div class="col-2 official-bg" style="padding: 0; margin-right: 5;">
            <button type="button" class="btn-prominfo btn-prominfo-fullsize" data-toggle="modal"
                    data-target="#researchModalSeance"><img class="" src="iconic/svg/magnifying-glass.svg" alt=""
                                                            width="60" height="60"/>
            </button>
        </div>
    </div>
</div>

<?php require('showSeance.inc.php');?>

<footer class="footer official-bg d-flex align-items-center ">

    <div class="container">
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal"
                data-target="#modalAddSeance">Ajouter une séance</button>
    </div>

</footer>


</body>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
        <?php if(isset($_GET['semaine'])){
        echo "$('#Semaine".$_GET['semaine']."').collapse('show')\n";
    }?>
        <?php if(isset($_GET['seance'])){
        echo "$('#collapseEvent".$_GET['seance']."').collapse('show')\n";
    }?>
    })
</script>
<script type="text/javascript" src="scripts/index.js"></script>

</html>
