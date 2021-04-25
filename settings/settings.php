<?php require '../checkConnection.inc.php';?>
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

    .navbar{
        margin-bottom: 2%;
    }

    @media (prefers-color-scheme: dark) {
        body {
            background: #141d26;
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

<body>

<?php include "../navbar.inc.php"; ?>
<main>
    <div class="container">
        <?php include '../modals/modalChangePass.inc.php';?>
    </div>
</main>

<main>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Changer votre mot de passe
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="../settings/passChangeUser.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <hr style = "border-color : red; size : 50px; width : 95%;">
        <br/>

        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des utilisateurs
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editUser.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des modules
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editModule.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des groupes
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editGroup.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des types de séances
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editTypeSeance.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des types de sémaphores
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editSemaphore.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des types d'évenements
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editTypesEvenements.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>

        <br/>

	   <div class="card">
            <div class="card-header">
                <div class = "row d-flex align-items-center">
                    <div class ="col-9 col-xl-10">
                        Gestion des limites
                    </div>
                    <div class ="col-3 col-xl-2">
                        <a href="editLimits.php" class="btn btn-primary">Y aller</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
