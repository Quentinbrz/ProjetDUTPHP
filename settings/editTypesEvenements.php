<?php

require '../checkConnection.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/default.css">
    <link rel="stylesheet" type="text/css" href="../css/settings.css">
    <title>PromInfo Agenda</title>

</head>

<style>

    @media (prefers-color-scheme: dark) {
        body {
            background: #141d26;
        }
        .modal-content {
            background: #141d26;
        }
        .darkModeInput{
            background: #141d26;
            color : white;
        }
        .darkModeText{
            color: white;
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
    }
    @media (prefers-color-scheme: light) {
        body {
            background: #fff;
        }
        h1{
            color: black;
        }

    }

    html {
        position: relative;
        min-height: 100%;
    }
    body {
        margin-bottom: 60px;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
    }

</style>

<body>
<?php include "../navbar.inc.php"; ?>
<main>
    <div class="container">
        <?php include '../modals/type_event/modalAddTE.inc.php';?>
        <?php include '../modals/type_event/modalDeleteTE.inc.php';?>
        <?php include '../modals/type_event/modalEditTE.inc.php';?>
    </div>
</main>

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-xl-2 col-4">
            <a class="btn btn-danger" href="settings.php">Retour</a>
        </div>
        <div class="col-xl-8 col-4">
            <div style="text-align: center;" class="darkModeText"><h5>Gestion des Types d'évenements</h5></div>
        </div>
        <div class="col-xl-2 col-4"></div>
    </div>
</div>

<div class="table-responsive-sm">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th scope="col">Libelle de l'évenement : </th>
            <th scope="col">Role  : </th>
            <th scope="col">Modifier  : </th>
            <th scope="col">Supprimer  : </th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($db->getTypeEvent() as $te) { ?>
            <tr>
                <td><?php echo $te->getLibTypeEvent();?></td>
                <td><?php echo $db->getLibWithIdRole($te->getIdRoleEvent());?></td>
                <td> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditTE" data-formidte ="<?php echo $te->getIdTypeEvent();?>"
				         style="height : 36px">
                        <img class= "mb-4" src="../iconic/svg/pencil.svg" alt="" width="20" height="20"/>
                    </button>
                </td>
                <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteTE"  data-formidte ="<?php echo $te->getIdTypeEvent();?>"
                             style="height : 36px">
                        <img class= "mb-4" src="../iconic/svg/ban.svg" alt="" width="20" height="20"/>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>



<footer class="footer official-bg d-flex align-items-center">
    <div class="container">
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#modalAddTE">Ajouter un type d'évenement </button>
    </div>
</footer>
</body>

<script>
$('#modalEditTE').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let idTE = button.data('formidte');


    document.getElementById('formIdTE').value = idTE;
});
    $('#modalDeleteTE').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        document.getElementById('formDelIdTE').value = button.data('formidte');
    });

</script>

</html>
