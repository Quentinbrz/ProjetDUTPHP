<?php
//Vérification des paramètres avant la suppression
	if(isset($_POST['formDelIdModule'])){
		if(!empty($_POST['formDelKeyUser']) AND !empty($_POST['formDelIdModule'])){
			$db->delModuleToUser($_POST['formDelKeyUser'],$_POST['formDelIdModule']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalDeleteModuleUser" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Suppression du module pour l'utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editModulesUser.php" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>

				<div class="modal-footer">
					<input type="hidden" name="formDelKeyUser" id="formKeyUser">
					<input type="hidden" name="formDelIdModule" id="idModuleDelete">
					<button type="submit" name="supprimer" class="btn btn-primary">Supprimer le module</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
