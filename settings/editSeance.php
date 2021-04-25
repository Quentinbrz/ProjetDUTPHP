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
        <?php include '../modals/seance/modalAddSeance.inc.php';?>
        <?php include '../modals/seance/modalDeleteSeance.inc.php';?>
    </div>
</main>

<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Module : </th>
            <th scope="col">Type de séance : </th>
            <th scope="col">Groupe : </th>
            <th scope="col">Création de la seance le : </th>
            <th scope="col">Supprimer  : </th>

        </tr>
        </thead>

        <tbody>
        <?php foreach($db->getAllSeances() as $seance) { ?>
            <tr>
                <td><?php echo $db->getLibModule($seance->getId_moduleName());?></td>
                <td><?php echo $seance->getType_seance();?></td>
                <td><?php echo $seance->getNom_group();?></td>
                <td><?php echo $seance->getDateTime();?></td>
                <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteSeance" data-formidseance="<?php echo $seance->getId_seance();?>"
                             style="height : 36px" >
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
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#modalAddSeance">Ajouter une séance </button>
    </div>
</footer>
</body>


<script>

    $('#modalDeleteSeance').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        document.getElementById('id_seance_delete').value = button.data('formidseance');
    });


</script>

</html>
