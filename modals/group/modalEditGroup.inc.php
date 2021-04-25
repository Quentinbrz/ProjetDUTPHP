<?php
//Vérification des paramètres avant la modification
	if(isset($_POST['formEditNomGroup'])){
		if(!empty($_POST['formEditNomGroup']) AND !empty($_POST['formEditIdGroup'])){
			//Cas où il n'y a pas de groupe père
			if(empty($_POST['formEditIdGroupPere'])){
				$db->changeGroup($_POST['formEditNomGroup'],null,$_POST['formEditIdGroup']);
			}else{
				//Cas où il y a un groupe père
				$id_pere=$db->getGroupWithNom($_POST['formEditIdGroupPere'])->getId();
				$db->changeGroup($_POST['formEditNomGroup'],$id_pere,$_POST['formEditIdGroup']);
			}
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
		}else{
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalEditGroup" tabindex="-1" role="dialog" aria-labelledby="modalGroupLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalGroupLabel">Modification d'un groupe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="formEditIdGroup" id="formEditIdGroup">
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditNomGroup">Changer le nom du groupe</label><br/>
							<input type="text" class="form-control darkModeInput" name="formEditNomGroup" id="formEditNomGroup" maxlength="10" required>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditIdGroupPere">Changer le groupe père</label><br/>
							<select class="form-control" name="formEditIdGroupPere" id="formEditIdGroupPere">
								<?php foreach($db->getNomGroups() as $groups) echo "<option>".$groups."</option>\n";?>
							</select>
						</div>
						<div class="col-3"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier le groupe</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
