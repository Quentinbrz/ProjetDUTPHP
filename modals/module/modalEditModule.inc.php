<?php
//Vérification des paramètres avant la modification
	if(isset($_POST['formEditCodeModule'])){
		if(!empty($_POST['formEditCodeModule']) AND !empty($_POST['formEditLibModule']) AND !empty($_POST['formEditCoulModule']) AND !empty($_POST['formEditIdModule'])){
			$db->changeModule($_POST['formEditCodeModule'],$_POST['formEditLibModule'],$_POST['formEditCoulModule'],$_POST['formEditIdModule']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalEditModule" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Modification d'un Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="formEditIdModule" id="formEditIdModule">
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditCodeModule">Changer code du module</label><br/>
							<input type="text" class="form-control darkModeInput" name="formEditCodeModule" id="formEditCodeModule" maxlength="8" required>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditLibModule">Changer le module</label><br/>
							<input type="text" class="form-control darkModeInput" name="formEditLibModule" id="formEditLibModule" maxlength="20" required>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditCoulModule">Changer couleur du module</label><br/>
							<input type="color" class="form-control darkModeInput" name="formEditCoulModule" id="formEditCoulModule" required>
						</div>
						<div class="col-3"></div>
					</div>

					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<center><div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="formEditRolesUser[]" id="formEditCheckboxT" value="3">
								<label class="form-check-label" for="formAddCheckboxT">Tuteur</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="formEditRolesUser[]" id="formEditCheckboxE" value="2">
								<label class="form-check-label" for="formAddCheckboxE">Enseignant</label>
							</div>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier le module</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
