<?php
//Vérification des paramètres avant la suppression
	if(isset($_POST['formDelIdTE'])){
		if(!empty($_POST['formDelIdTE'])){
			$db->deleteTypeEvent($_POST['formDelIdTE']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalDeleteTE" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Suppression d'un type d'évenement </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editTypesEvenements.php" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>
				<div class="modal-footer">
					<input type="hidden" name="formDelIdTE" id="formDelIdTE">
					<button type="submit" name="supprimer" class="btn btn-primary">Supprimer ce type d'évenement</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
