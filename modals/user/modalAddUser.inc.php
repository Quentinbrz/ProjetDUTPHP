<?php
//Vérification des paramètres avant l'ajout
if(isset($_POST['formAddIdUser']) AND isset($_POST['formAddNomUser']) AND isset($_POST['formAddPrenomUser'])){
	if(!empty($_POST['formAddIdUser']) AND !empty($_POST['formAddNomUser']) AND !empty($_POST['formAddPrenomUser']) AND !empty($_POST['formAddPassUser']) AND !empty($_POST['formAddRolesUser'])){

		//Vérification de la longeur des paramètres saisis
		$error=false;
		$msgError = array();
		if(strlen($_POST['formAddIdUser'])>15){
			$error=true;
			array_push($msgError,"L'identifiant était trop grand (20 caratère max)");
		}
		if(strlen($_POST['formAddNomUser'])>20){
			$error=true;
			array_push($msgError,"Le nom était trop grand (20 caratère max)");
		}
		if(strlen($_POST['formAddPrenomUser'])>20){
			$error=true;
			array_push($msgError,"Le prenom était trop grand (20 caratère max)");
		}
		if($error==false){executeAddUser();}
		else{printError($msgError);}

	}else{printError("Un des paramètres était manquant");}
}


function printError($error){
	foreach ($error as $msg) {
		echo "<div class=\"alert alert-danger\"> $msg <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">&times;</span>
				</button></div>";
	}
}

function executeAddUser(){
	$db=$GLOBALS["db"];
	$password_hash = password_hash($_POST['formAddPassUser'],PASSWORD_DEFAULT);
	$db->insertUser($_POST['formAddIdUser'],$_POST['formAddNomUser'],$_POST['formAddPrenomUser'],$password_hash);
	$keyUser = $db->getUser($_POST['formAddIdUser'])->getKeyUser();
	foreach($_POST['formAddRolesUser'] as $roles_add){
		$db->addRoleToUser($roles_add,$keyUser);
	}

}
?>

<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title text-center" id="modalAddUser">Ajouter un nouvel utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editUser.php" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddIdUser">Identifiant</label></div>
							<input type="text" class="form-control darkModeInput" name="formAddIdUser" id="formAddIdUser" maxlength="15" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
						<div style="text-align: center;"><label for="formAddNomUser">Nom</label><br/></div>
							<input type="text" class="form-control darkModeInput" name="formAddNomUser" id="formAddNomUser" maxlength="20" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div></center>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
						<center><label for="formAddPrenomUser">Prénom</label><br/></center>
							<input type="text" class="form-control darkModeInput" name="formAddPrenomUser" id="formAddPrenomUser" maxlength="20" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<center><div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="formAddRolesUser[]" id="formAddCheckboxT" value="3">
								<label class="form-check-label" for="formAddCheckboxT">Tuteur</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="formAddRolesUser[]" id="formAddCheckboxE" value="2">
								<label class="form-check-label" for="formAddCheckboxE">Enseignant</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="formAddRolesUser[]" id="formAddCheckboxA" value="1">
								<label class="form-check-label" for="formAddCheckboxA">Admin</label>
							</div></center>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formPass">Mot de passe</label><br/></div>
							<input type="button" class="btn btn-primary form-control" name="formGenPassBtn" id="formGenPassBtn" value="Générer un mot de passe" onClick="generatePass()">
							<input type="hidden" class=" form-control" name="formAddPassUser" id="formAddPassUser" readonly required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ajouter l'utilisateur</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>

function generatePass(){
	document.getElementById('formGenPassBtn').type = 'hidden';
	document.getElementById('formAddPassUser').type = 'text';
	document.getElementById('formAddPassUser').value = createPass();
}

</script>
