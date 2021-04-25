<?php
//Vérification des paramètres avant la modification
	if(isset($_POST['formIdTE'])){
		if(!empty($_POST['formIdTE']) AND !empty($_POST['formEditRoleTE'])){
			$db->changeTE($_POST['formIdTE'],$db->getIdRoleWithLib($_POST['formEditRoleTE']));
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalEditTE" tabindex="-1" role="dialog" aria-labelledby="modalTELabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditTE">Modification d'un type d'évenement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editTypesEvenements.php" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="formIdTE" id="formIdTE">
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditTE">Changer le Rôle </label><br/>
							<select class="form-control darkModeInput" name="formEditRoleTE" id="formEditRoleTE" required>
								<?php foreach($db->getAllRoles() as $role) echo "<option>".$role."</option>\n";?>
							</select>
						</div>
						<div class="col-3"></div>
					</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier le type d'évènement</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
