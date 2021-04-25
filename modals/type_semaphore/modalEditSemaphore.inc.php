<?php
//Vérification des paramètres avant la modification
	if(isset($_POST['formEditIdSemaphore'])){
		if(!empty($_POST['formEditIdSemaphore']) AND !empty($_POST['formEditLibSemaphore'] AND !empty($_POST['formEditColorSemaphore'])  AND !empty($_POST['formEditTextColorSemaphore']))){
				$db->changeSemaphore($_POST['formEditIdSemaphore'],$_POST['formEditLibSemaphore'],$_POST['formEditColorSemaphore'],$_POST['formEditTextColorSemaphore']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalEditSemaphore" tabindex="-1" role="dialog" aria-labelledby="modalSemaphoreLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalSemaphoreLabel">Modification d'un sémaphore</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="formEditIdSemaphore" id="formEditIdSemaphore">
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditLibSemaphore">Changer le libellé</label><br/>
							<input type="text" class="form-control darkModeInput" name="formEditLibSemaphore" id="formEditLibSemaphore" required>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditColorSemaphore">Changer la couleur </label><br/>
							<input type="color" class="form-control darkModeInput" name="formEditColorSemaphore" id="formEditColorSemaphore" required>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditTextColorSemaphore">Changer la couleur du texte </label><br/>
							<input type="color" class="form-control darkModeInput" name="formEditTextColorSemaphore" id="formEditTextColorSemaphore" required>
						</div>
						<div class="col-3"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier le sémaphore</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
