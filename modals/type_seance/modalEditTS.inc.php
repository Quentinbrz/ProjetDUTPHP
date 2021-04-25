<?php
//Vérification des paramètres avant la modification
	if(isset($_POST['formIdTS'])){
		if(!empty($_POST['formIdTS']) AND !empty($_POST['formEditRoleTS'])){
			$db->changeTS($_POST['formIdTS'],$db->getIdRoleWithLib($_POST['formEditRoleTS']));
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalEditTS" tabindex="-1" role="dialog" aria-labelledby="modalTSLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditTS">Modification d'un type de séance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editTypeSeance.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="formIdTS" id="formIdTS">
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditTS">Changer le Rôle </label><br/>
							<select class="form-control darkModeInput" name="formEditRoleTS" id="formEditRoleTS" required>
								<?php foreach($db->getAllRoles() as $role) echo "<option>".$role."</option>\n";?>
							</select>
						</div>
						<div class="col-3"></div>
					</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier le type de séance</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
