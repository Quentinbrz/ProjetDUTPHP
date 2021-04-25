<?php require '../checkConnection.inc.php';?>
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
<?php include "../navbar.inc.php";

	$modif=false;
	if(isset($_POST['formPieceJointe'])){
		if(!empty($_POST['formPieceJointe'])){
			$db->editNbPieceJointeMax($_POST['formPieceJointe']);
			$modif=true;
		}
	}
	if(isset($_POST['formNbEvent'])){
		if(!empty($_POST['formPieceJointe'])){
			$db->editNbEventMax($_POST['formNbEvent']);
			$modif=true;
		}
	}
	if(isset($_POST['valider'])){
		echo '<div class="alert alert-success"> Modification effectuée <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
	}
?>

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-xl-2 col-4">
            <a class="btn btn-danger" href="settings.php">Retour</a>
        </div>
        <div class="col-xl-8 col-4">
            <div style="text-align: center;" class="darkModeText"><h5>Gestion des Limites</h5></div>
        </div>
        <div class="col-xl-2 col-4"></div>
    </div>
</div>

<div class="container align-middle">
	<form action="editLimits.php" method="post">
		<div class="modal-body ">
			<div class="form-group row">
				<div class="col-3-xl col-1"></div>
				<div class="col-6-xl col-10">
					<div style="text-align: center;"><label for="formPieceJointe">Nombre de pièce jointe par évenement</label></div>
					<input type="text" class="form-control darkModeInput" name="formPieceJointe" id="formPieceJointe" value= "<?php echo $db->getNbPieceJointeMax() ;?>">
				</div>
				<div class="col-3-xl col-1"></div>
			</div>
			<div class="form-group row">
				<div class="col-3-xl col-1"></div>
				<div class="col-6-xl col-10">
					<div style="text-align: center;"><label for="formNbEvent">Nombre d'évenements par séance</label></div>
					<input type="text" class="form-control darkModeInput" name="formNbEvent" id="formNbEvent" value= "<?php echo $db->getNbEventMax() ;?>">
				</div>
				<div class="col-3-xl col-1"></div>
			</div>
		</div>

</div>


<footer class="footer official-bg d-flex align-items-center">
  <div class="container">
      <input class="btn btn-success btn-block" type="submit" value="Valider" name="valider">

  </div>
</form>
</footer>
</body>

</html>
