<?php

require 'checkConnection.inc.php';
$dureeSeance  = 0;
$nbActivities = 0;
$nbEvent      = 0;
function getYear($month){
    if($month > 8){
        if (date('m') > 8) echo date('Y'); else echo date('Y') - 1;
    }else{
        if (date('m') < 7) echo date('Y'); else echo date('Y') + 1;
    }
}
//ini_set('display_errors','1');
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
        <?php include 'modals/event/modalEditEvent.inc.php';?>
        <?php include 'modals/event/modalDeleteEvent.inc.php';?>
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

<button type="button" class="btn-prominfo" data-toggle="modal"data-target="#researchModalSeance" style="font-weight: bold; height: 3rem;">
    Rechercher
</button>


<?php require('showSeanceFiltrer.inc.php');?>

<footer class="footer official-bg d-flex align-items-center ">
    <div class="container-fluid" style="height: 60px;">
        <div class="row" style="color:#fff; font-weight: bold;">
            <div class="col-xl-3" style="text-align: left;">
                <?php 
                $message = $nbActivities . " activité";
                $nbActivities < 2 ? "" : $message = $message . "s";
                $message = $message ." et " . $nbEvent . " événement";
                $nbEvent  < 2 ? "" : $message = $message . "s";
                echo $message;
                ?>
            </div>

            <div class="col-xl-6"></div>

            <div class="col-xl-3" style="text-align: right;">
                Total durée: 
                <?php  
                if ($dureeSeance == "00:00") 
                    echo "00:00";
                else
                    echo $dureeSeance; 
                ?>
            </div>
        </div>
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