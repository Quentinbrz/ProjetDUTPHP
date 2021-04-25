<?php
//Vérification des paramètres avant la modification

	if(isset($_POST['formEditPass']) && !empty($_POST['formEditPass'])){
		$password_hash = password_hash($_POST['formEditPass'], PASSWORD_DEFAULT);
		$db->changePassHash($_POST['formEditKeyUser'],$password_hash,'1');
	}
	if(isset($_POST['formEditKeyUser'])){
		if(!empty($_POST['formEditKeyUser']) AND !empty($_POST['formEditIdUser']) AND !empty($_POST['formEditNomUser']) AND!empty($_POST['formEditPrenomUser']) AND !empty($_POST['formEditRolesUser'])){
			//Vérification de la longueur des paramètres saisis
			$error=false;
			$msgError = array();
			if(strlen($_POST['formEditIdUser'])>15){
				$error=true;
				array_push($msgError,"L'identifiant était trop grand (20 caratère max)");
			}
			if(strlen($_POST['formEditNomUser'])>20){
				$error=true;
				array_push($msgError,"Le nom était trop grand (20 caratère max)");
			}
			if(strlen($_POST['formEditPrenomUser'])>20){
				$error=true;
				array_push($msgError,"Le prenom était trop grand (20 caratère max)");
			}
			if($error==false){executeEditUser();}
			else{printError($msgError);}

		}else{
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}


function executeEditUser(){
	$db = $GLOBALS["db"];
	if((in_array('1',$_POST['formEditRolesUser']) AND $_SESSION['Client']->getKeyUser() == $_POST['formEditKeyUser']) OR $_SESSION['Client']->getKeyUser() != $_POST['formEditKeyUser']){
		$db->editUser($_POST['formEditKeyUser'],$_POST['formEditIdUser'],$_POST['formEditNomUser'],$_POST['formEditPrenomUser']);
		$rolesUser = $db->getRoles($_POST['formEditKeyUser']);
		foreach($_POST['formEditRolesUser'] as $rolesEdit){
			if(!in_array($rolesEdit,$rolesUser)){
				$db->addRoleToUser($rolesEdit,$_POST['formEditKeyUser']);
			}
		}
		foreach($rolesUser as $roles){
			if(!in_array($roles,$_POST['formEditRolesUser'])){
				$db->removeRoleToUser($roles,$_POST['formEditKeyUser']);
			}
		}
	}else{
		echo '<div class="alert alert-danger"> Vous ne pouvez pas vous retirer votre grade administrateur <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button></div>';
	}

}
?>

<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title text-center" id="modalEditUser">Modification d'un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editUser.php" method="post">
				<div class="modal-body">
				<input type="hidden" class="form-control" name="formEditKeyUser" id="formEditKeyUser">
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<center><label for="form_id_user">Changer identifiant</label></center>
							<input type="text" class="form-control darkModeInput" name="formEditIdUser" id="formEditIdUser" maxlength="15" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
						<center><label for="form_nom_user">Changer nom</label><br/></center>
							<input type="text" class="form-control darkModeInput" name="formEditNomUser" id="formEditNomUser" maxlength="20" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div></center>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
						<center><label for="form_prenom_user">Changer prénom</label><br/></center>
							<input type="text" class="form-control darkModeInput" name="formEditPrenomUser" id="formEditPrenomUser" maxlength="20" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<center><div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="formEditRolesUser[]" id="formEditCheckboxT" value="3">
								<label class="form-check-label" for="formEditCheckboxT">Tuteur</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="formEditRolesUser[]" id="formEditCheckboxE" value="2">
								<label class="form-check-label" for="form_edit_checkbox_E">Enseignant</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="checkbox" name="formEditRolesUser[]" id="formEditCheckboxA" value="1">
								<label class="form-check-label" for="form_edit_checkbox_A">Admin</label>
							</div></center>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<input type="button" class="btn btn-primary form-control" id="formEditResetPassBtn" value="Réinitialiser le mot de passe" onClick="resetPass()">
							<div class="input-group mb-3">
								<input type="hidden" class="form-control" name="formEditPass" id="formEditPass" readonly>
								<div class="input-group-append">
									<input type="hidden" class="btn btn-danger form-control" id="formEditCancelResetPassBtn" value="X" onClick="cancelResetPass()">
								</div>
							</div>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<a class="btn btn-primary form-control" id="modifModuleHref">Modifier les modules</a>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<a class="btn btn-primary form-control" id="modifGroupeHref"> Modifier les groupes</a>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier l'utilisateur</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>

function cancelResetPass(){
	document.getElementById('formEditResetPassBtn').type = 'button'
	document.getElementById('formEditCancelResetPassBtn').type = 'hidden'
	document.getElementById('formEditPass').type = 'hidden'
	document.getElementById('formEditPass').value = ""
}

function resetPass(){
	document.getElementById('formEditResetPassBtn').type = 'hidden'
	document.getElementById('formEditCancelResetPassBtn').type = 'button'
	document.getElementById('formEditPass').type = 'text'
	document.getElementById('formEditPass').value = createPass()
}

function createPass(){
   var result           = '';
   var upperCase       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   var lowerCase       = 'abcdefghijklmnopqrstuvwxyz';
   var numbers       = '0123456789';
   for ( var i = 0; i < 3; i++ ) {
      result += upperCase.charAt(Math.floor(Math.random() * 26));
	  result += lowerCase.charAt(Math.floor(Math.random() * 26));
	  result += numbers.charAt(Math.floor(Math.random() * 10));
   }
   return result;
}

</script>
