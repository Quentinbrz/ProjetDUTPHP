<?php
//Vérification des paramètres avant la suppression
	if(isset($_POST['fromDelSemaphoreSubmit'])){
		if(!empty($_POST['formDelIdSemaphore'])){
			$db->deleteTypeSemaphore($_POST['formDelIdSemaphore']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalDeleteSemaphore" tabindex="-1" role="dialog" aria-labelledby="modalSemaphoreLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalSemaphoreLabel" style="margin-left : 30%">Suppression d'un sémaphore</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>

				<div class="modal-footer">
					<input type="hidden" name="formDelIdSemaphore" id="formDelIdSemaphore">
					<button type="submit" name="fromDelSemaphoreSubmit" class="btn btn-primary">Supprimer le sémaphore</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
