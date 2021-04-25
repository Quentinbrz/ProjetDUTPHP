<?php
//Vérification des paramètres avant la suppression
	if(isset($_POST['supprimer'])){
		if($_POST['formDelIdUser'] != $_SESSION['Client']->getKeyUser())$db->deleteUser($_POST['formDelIdUser']);
	}
?>

<div class="modal fade" id="modalDeleteUser" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Suppression d'un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editUser.php" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>
				<div class="modal-footer">
					<input type="hidden" name="formDelIdUser" id="formDelIdUser">
					<button type="submit" name="supprimer" class="btn btn-primary">Supprimer l'utilisateur</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
