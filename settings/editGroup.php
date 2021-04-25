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
        <?php include '../modals/group/modalEditGroup.inc.php';?>
        <?php include '../modals/group/modalDeleteGroup.inc.php';?>
        <?php include '../modals/group/modalAddGroup.inc.php';?>
    </div>
</main>

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-xl-2 col-4">
            <a class="btn btn-danger" href="settings.php">Retour</a>
        </div>
        <div class="col-xl-8 col-4">
            <div style="text-align: center;" class="darkModeText"><h5>Gestion des Groupes</h5></div>
        </div>
        <div class="col-xl-2 col-4"></div>
    </div>
</div>
<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Nom du groupe</th>
            <th scope="col">Nom du père</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>

        </thead>

        <tbody>
        <?php foreach($db->getGroups() as $group) { ?>
            <tr>
                <td><?php echo $group->getNom();?></td>
                <td><?php foreach($db->getGroups() as $groupPere) if($groupPere->getId() == $group->getIdPere()){ echo $groupPere->getNom(); break;}?></td>
                <td> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditGroup"
                             data-formidgroup ="<?php echo $group->getId();?>" data-formnomgroup="<?php echo $group->getNom();?>"
                             data-formidperegroup="<?php echo $group->getIdPere();?>" style="height : 36px">
                        <img class= "mb-4" src="../iconic/svg/pencil.svg" alt="" width="20" height="20"/>
                    </button>
                </td>
                <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteGroup" data-formidgroup="<?php echo $group->getId();?>"
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
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#modalAddGroup">Ajouter un groupe </button>
    </div>
</footer>
</body>

<script>
    $('#modalEditGroup').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let idGroup = button.data('formidgroup');
        let nomGroup = button.data('formnomgroup');
        let idPereGroup = button.data('formidperegroup');


        document.getElementById('formEditIdGroup').value = idGroup;
        document.getElementById('formEditNomGroup').value = nomGroup;
        document.getElementById('formEditIdGroupPere').value = idPereGroup;
    });

    $('#modalDeleteGroup').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let idGroup = button.data('formidgroup');
        console.log(idGroup);

        document.getElementById('formDelIdGroup').value = idGroup;
    });


</script>

</html>
