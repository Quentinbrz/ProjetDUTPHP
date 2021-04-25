<?php

//Vérification des paramètres avant la suppression
	if(isset($_POST['formDelEventSubmit'])){
		if(!empty($_POST['formDelIdEvent'])){
			//Update dans la bdd
			$db->deleteEvent($_POST['formDelIdEvent']);
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres

		}else{
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalDeleteEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEventLabel">Suppression d'un événement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form id="formHrefActionDeleteEvent" method="post" action ="index.php">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>

				<div class="modal-footer">
					<input type="hidden" name="formDelIdEvent" id="formDelIdEvent">
					<button type="submit" name="formDelEventSubmit" class="btn btn-primary">Supprimer l'événement</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
