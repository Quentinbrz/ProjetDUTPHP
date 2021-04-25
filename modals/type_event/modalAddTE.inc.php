<?php
//Vérification des paramètres avant l'ajout
	if(isset($_POST['formAddLibTypeEvent'])){
		if(!empty($_POST['formAddLibTypeEvent']) and !empty($_POST['formAddRolesTe'])){
			$db->insertTypeEvent($_POST['formAddLibTypeEvent'],array_shift($_POST['formAddRolesTe']));
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalAddTE" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Ajout d'un type d'événement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editTypesEvenements.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control darkModeInput" name="formAddLibTypeEvent" id="formAddLibTypeEvent" placeholder="Nom du type de séance" maxlength="10">
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
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ajouter</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
