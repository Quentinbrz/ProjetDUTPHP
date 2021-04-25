<?php
//Vérification des paramètres avant l'ajout
	if(isset($_POST['formAddLibSemaphore'])){
		if(!empty($_POST['formAddLibSemaphore']) AND !empty($_POST['formAddColorSemaphore']) AND !empty($_POST['formAddTextColorSemaphore'])){
			$db->addTypeSemaphore($_POST['formAddLibSemaphore'],$_POST['formAddColorSemaphore'],$_POST['formAddTextColorSemaphore']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button></div>';
		}
	}
?>

<div class="modal fade" id="modalAddSemaphore" tabindex="-1" role="dialog" aria-labelledby="modalSemaphoreLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title text-center" id="modalAddSemaphore">Ajouter un nouveau Semaphore</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddLibSemaphore">Libellé du sémaphore</label></div>
							<input type="text" class="form-control darkModeInput" name="formAddLibSemaphore" id="formAddLibSemaphore" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddColorSemaphore">Couleur de sémaphore</label></div>
							<input type="color" class="form-control darkModeInput" name="formAddColorSemaphore" id="formAddColorSemaphore" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<div style="text-align: center;"><label for="formAddTextColorSemaphore">Couleur de texte du sémaphore</label></div>
							<input type="color" class="form-control darkModeInput" name="formAddTextColorSemaphore" id="formAddTextColorSemaphore" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Ajouter un sémaphore</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
