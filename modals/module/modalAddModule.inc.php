<?php
//Vérification des paramètres avant l'ajout
if(isset($_POST['formAddCodeModule'])){
	if(!empty($_POST['formAddCodeModule']) AND !empty($_POST['formAddLibModule']) AND !empty($_POST['formAddCoulModule']AND !empty($_POST['formAddRolesTe']))){
		$db->insertModule($_POST['formAddCodeModule'],$_POST['formAddLibModule'],$_POST['formAddCoulModule'],array_shift($_POST['formAddRolesTe']));
	}else{
		//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
		echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
	}
}



?>

<div class="modal fade" id="modalAddModule" tabindex="-1" role="dialog" aria-labelledby="modalUserLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title text-center" id="modalAddUser">Ajouter un nouveau Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddCodeModule">Code du Module</label></div>
							<input type="text" class="form-control darkModeInput" name="formAddCodeModule" id="formAddCodeModule" maxlength="8" required autofocus>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddLibModule">Nom du Module</label></div>
							<input type="text" class="form-control darkModeInput" name="formAddLibModule" id="formAddLibModule" maxlength="20" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddCoulModule">Couleur</label></div>
							<input type="color" class="form-control darkModeInput" name="formAddCoulModule" id="formAddCoulModule" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<center><div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="formAddRolesTe[]" id="formAddCheckboxT" value="3" checked>
								<label class="form-check-label" for="formAddCheckboxT">Tuteur</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="formAddRolesTe[]" id="formAddCheckboxE" value="2">
								<label class="form-check-label" for="formAddCheckboxE">Enseignant</label>
							</div></center>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ajouter le module</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>
