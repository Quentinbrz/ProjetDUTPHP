<?php

require '../checkConnection.inc.php';
if(isset($_GET['keyUser'])) $keyUser = $_GET['keyUser'];
if(isset($_POST['formDelKeyUser'])) $keyUser = $_POST['formDelKeyUser'];
if(isset($_POST['formAddKeyUser'])) $keyUser = $_POST['formAddKeyUser'];
if(empty($keyUser)) header('Location: /settings/editUser.php');
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
        <?php include '../modals/group/modalDeleteGroupUser.inc.php';?>
        <?php include '../modals/group/modalAddGroupUser.inc.php';?>
    </div>
</main>

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-xl-2 col-4">
            <a class="btn btn-danger" href="editUser.php?keyUser=<?php echo $keyUser;?>">Retour</a>
        </div>
        <div class="col-xl-8 col-4">
            <div style="text-align: center;" class="darkModeText"><h5>Groupes de <?php echo $db->getIdUser($keyUser);?></h5></div>
        </div>
        <div class="col-xl-2 col-4"></div>
    </div>
</div>

<div>
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th scope="col">Nom du groupe : </th>
            <th scope="col">Supprimer  : </th>
        </tr>
        </thead>

        <tbody>
        <?php foreach($db->getGroupsOfUser($keyUser) as $group) { ?>
            <tr>
                <td><?php echo $group->getNom();?></td>
                <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteGrpUser" data-formidgroup="<?php echo $group->getId();?>"
                             data-formkeyuser="<?php echo $keyUser;?>" style="height : 36px" >
                        <img class= "mb-4" src="../iconic/svg/ban.svg" alt="" width="20" height="20"/>
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<script>

    $('#modalDeleteGrpUser').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let idGroup = button.data('formidgroup');
        let keyUser = button.data('formkeyuser');

        document.getElementById('formIdGroup').value = idGroup;
        document.getElementById('formKeyUser').value = keyUser;
    });

    $('#modalAddGrpUser').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        document.getElementById('formKeyUserAdd').value = button.data('formkeyuser');
    });
</script>



<footer class="footer official-bg d-flex align-items-center">
    <div class="container">
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#modalAddGrpUser" data-formkeyuser="<?php echo $keyUser;?>">Ajouter un groupe </button>
    </div>
</footer>
</body>


</html>
