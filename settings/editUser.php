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
        <?php include '../modals/user/modalErrorDelUser.inc.php';?>
        <?php include '../modals/user/modalEditUser.inc.php';?>
        <?php include '../modals/user/modalDeleteUser.inc.php';?>
        <?php include '../modals/user/modalAddUser.inc.php';?>
    </div>
</main>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-2">
		    <a class="btn btn-danger" href="settings.php">Retour</a>
        </div>
        <div class="col-xl-6">
		   <div style="text-align: center;" class="darkModeText"><h5>Gestion des Utilisateurs</h5></div>
        </div>
        <div class="col-xl-4"><input class="form-control" type="text" placeholder="Rechercher par identifiant" id="searchInput" onkeyup="searchInTable()"></div>
    </div>
</div>

<div class= "table-responsive-sm">
    <table class="table table-hover" id="tableUser">
        <thead>
        <tr>
            <th scope="col">Identifiant : </th>
            <th scope="col">Nom : </th>
            <th scope="col">Prenom : </th>
            <th scope="col">Création le : </th>
            <th scope="col">Dernière modification le : </th>
            <th scope="col">Modifier  : </th>
            <th scope="col">Supprimer  : </th>

        </tr>
        </thead>

        <tbody>
        <?php foreach($db->getUsers() as $user) { ?>
            <tr>
                <td><?php echo $user->getIdUser();?></td>
                <td><?php echo $user->getNomUser();?></td>
                <td><?php echo $user->getPrenomUser();?></td>
                <td><?php echo $user->getDateCreation();?></td>
                <td><?php echo $user->getDateModification();?></td>
                <td> <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEditUser" data-formkeyuser="<?php echo $user->getKeyUser();?>"
                             data-formiduser="<?php echo $user->getIdUser();?>" data-formnomuser="<?php echo $user->getNomUser();?>"
                             data-formprenomuser="<?php echo $user->getPrenomUser();?>" data-formisadmin="<?php echo in_array('1',$db->getRoles($user->getKeyUser()));?>"
                             data-formistuteur="<?php echo in_array('3',$db->getRoles($user->getKeyUser()));?>" data-formisenseignant="<?php echo in_array('2',$db->getRoles($user->getKeyUser()));?>"
                             style="height : 36px">
                        <img class= "mb-4" src="../iconic/svg/pencil.svg" alt="" width="20" height="20"/>
                    </button>
                </td>
                <td> <button type="button" class="btn btn-danger" data-toggle="modal" onClick="showDelUser(<?php echo $_SESSION['Client']->getKeyUser().','.$user->getKeyUser();?>)" style="height : 36px" >
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
        <button type="button" class="btn btn-lg btn-block btn-success" data-toggle="modal" data-target="#modalAddUser">Ajouter un utilisateur </button>
    </div>
</footer>
</body>

<script>
    <?php if(isset($_GET['keyUser']) AND !empty($_GET['keyUser'])){
        $user = $db->getUserWithKey($_GET['keyUser']);?>

        $('#modalEditUser').modal('show');
        let keyUser = '<?php echo  $user->getKeyUser();?>';
        let idUser = '<?php echo  $user->getIdUser();?>';
        let nomUser = '<?php echo  $user->getNomUser();?>';
        let prenomUser = '<?php echo  $user->getPrenomUser();?>';
        let isAdmin = '<?php echo in_array('1',$db->getRoles($user->getKeyUser()));?>';
        let isEnseignant = '<?php echo in_array('2',$db->getRoles($user->getKeyUser()));?>';
        let isTuteur = '<?php echo in_array('3',$db->getRoles($user->getKeyUser()));?>';
        document.getElementById('formEditKeyUser').value = keyUser;
        document.getElementById('formEditIdUser').value = idUser;
        document.getElementById('formEditNomUser').value = nomUser;
        document.getElementById('formEditPrenomUser').value = prenomUser;
        document.getElementById('formEditCheckboxA').checked = isAdmin;
        document.getElementById('formEditCheckboxE').checked = isEnseignant;
        document.getElementById('formEditCheckboxT').checked = isTuteur;
        document.getElementById('modifModuleHref').href = '/PromInfo/settings/editModulesUser.php?keyUser='.concat(keyUser);
        document.getElementById('modifGroupeHref').href = '/PromInfo/settings/editGroupsUser.php?keyUser='.concat(keyUser);
    <?php
    }?>
</script>
<script type="text/javascript" src="../scripts/editUser.js"></script>

</html>
