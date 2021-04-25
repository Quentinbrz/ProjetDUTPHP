<?php
//Vérification des paramètres avant la suppression
	if(isset($_POST['fromDelGroupSubmit'])){
		if(!empty($_POST['formDelIdGroup'])){
			$db->deleteGroup($_POST['formDelIdGroup']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalDeleteGroup" tabindex="-1" role="dialog" aria-labelledby="modalGroupLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel" style="margin-left : 30%">Suppression d'un Groupe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>

				<div class="modal-footer">
					<input type="hidden" name="formDelIdGroup" id="formDelIdGroup">
					<button type="submit" name="fromDelGroupSubmit" class="btn btn-primary">Supprimer le groupe</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
