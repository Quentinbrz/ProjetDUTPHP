<?php

require '../checkConnection.inc.php';
ini_set("display_errors", 1);
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
        <?php include '../modals/module/modalEditModule.inc.php';?>
        <?php include '../modals/module/modalDeleteModule.inc.php';?>
        <?php include '../modals/module/modalAddModule.inc.php';?>
    </div>
</main>

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-xl-2 col-4">
            <a class="btn btn-danger" href="settings.php">Retour</a>
        </div>
        <div class="col-xl-8 col-4">
            <div style="text-align: center;" class="darkModeText"><h5>Gestion des Modules</h5></div>
        </div>
        <div class="col-xl-2 col-4"></div>
    </div>
</div>

<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Code du Module : </th>
            <th scope="col">Module : </th>
            <th scope="col">Couleur : </th>
            <th scope="col">Création du module le : </th>
            <th scope="col">Dernière modification le : </th>
            <th scope="col">Modifier  : </th>
            <th scope="col">Supprimer  : </th>

        </tr>
        </thead>

        <tbody>
        <?php foreach($db->getModules() as $module) { ?>
            <tr>
                <td><?php echo $module->getCodeModule();?></td>
                <td><?php echo $module->getLibModule();?></td>
                <td><?php echo $module->getCoulModule();?></td>
                <td><?php echo $module->getDateCreation();?></td>
                <td><?php echo $module->getDateModification();?></td>
                <td> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditModule"
                             data-formidmodule ="<?php echo $module->getId_Module();?>" data-formcodemodule="<?php echo $module->getCodeModule();?>"
                             data-formlibmodule="<?php echo $module->getLibModule();?>" data-formcouleur   ="<?php echo $module->getCoulModule();?>" data-formrolemodule="<?php echo $module->getIdRoleModule();?>"
                             style="height : 36px">
                        <img class= "mb-4" src="../iconic/svg/pencil.svg" alt="" width="20" height="20"/>
                    </button>
                </td>
                <td> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteModule" data-formidmodule="<?php echo $module->getId_Module();?>"
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
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#modalAddModule">Ajouter un module </button>
    </div>
</footer>
</body>



<script>
    $('#modalEditModule').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let idModule = button.data('formidmodule');
        let codeCoul = button.data('formcodemodule');
        let libModule = button.data('formlibmodule');
        let coulModule = button.data('formcouleur');
        let roleModule = button.data('formrolemodule');
        
        if(roleModule == 3) document.getElementById('formEditCheckboxT').checked = true;
        if(roleModule == 2) document.getElementById('formEditCheckboxE').checked = true;

        document.getElementById('formEditIdModule').value = idModule;
        document.getElementById('formEditCodeModule').value = codeCoul;
        document.getElementById('formEditLibModule').value = libModule;
        document.getElementById('formEditCoulModule').value = coulModule;
        
    });

    $('#modalDeleteModule').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        document.getElementById('formDelIdModule').value = button.data('formidmodule');
    });

</script>

</html>
