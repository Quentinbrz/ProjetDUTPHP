<?php
//Vérification des paramètres avant la suppression
	if(isset($_POST['supprimer'])){
		if(!empty($_POST['formDelIdSeance'])){
			$db->deleteSeance($_POST['formDelIdSeance']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}
	}
?>

<div class="modal fade" id="modalDeleteSeance" tabindex="-1" role="dialog" aria-labelledby="modalSeanceLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalSeanceLabel" style="margin-left : 30%">Suppression d'une séance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="index.php" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>

				<div class="modal-footer">
					<input type="hidden" name="formDelIdSeance" id="formDelIdSeance">
					<button type="submit" name="supprimer" class="btn btn-primary">Supprimer la séance</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
