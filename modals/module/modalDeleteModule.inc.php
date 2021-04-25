<?php
//Vérification du paramètre avant la suppression
	if(isset($_POST['fromDelModuleSubmit'])){
		$db->deleteModule($_POST['formDelIdModule']);

	}
?>

<div class="modal fade" id="modalDeleteModule" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel" style="margin-left : 30%">Modification d'un Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body darkModeText">
					Êtes-vous sûr de vouloir supprimer ?
				</div>

				<div class="modal-footer">
					<input type="hidden" name="formDelIdModule" id="formDelIdModule">
					<button type="submit" name="fromDelModuleSubmit" class="btn btn-primary">Supprimer le module</button>
					<button type="button"  class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
