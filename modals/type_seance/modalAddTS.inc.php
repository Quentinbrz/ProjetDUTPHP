<?php
//Vérification des paramètres avant l'ajout
	if(isset($_POST['formAddLibTS'])){
		if(!empty($_POST['formAddLibTS']) && !empty($_POST['formEditRolesTs'])){
				$db->addTypeSeance($_POST['formAddLibTS'],array_shift($_POST['formEditRolesTs']));
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalAddTS" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Ajout d'un type de séance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editTypeSeance.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control darkModeInput" name="formAddLibTS" id="formAddLibTS" maxlength="10" placeholder="Nom du type de séance">
					</div>

					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<center><div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="formEditRolesTs[]" id="formEditCheckboxT" value="3" checked>
								<label class="form-check-label" for="formAddCheckboxT">Tuteur</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="formEditRolesTs[]" id="formEditCheckboxE" value="2">
								<label class="form-check-label" for="formAddCheckboxE">Enseignant</label>
							</div></center>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ajouter</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>


			</form>
		</div>
	</div>
</div>
