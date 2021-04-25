<?php
//Vérification des paramètres avant l'ajout
	if(isset($_POST['formAddLibGroup'])){
		if(!empty($_POST['formAddLibGroup']) AND !empty($_POST['formAddKeyUser'])){
			$db->addGroupToUser($_POST['formAddKeyUser'],$_POST['formAddLibGroup']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalAddGrpUser" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Ajout d'un groupe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editGroupsUser.php" method="post">
				<div class="modal-body">
					<div class="form-group">
                        <label for="group">Groupe</label>
                        <select class="form-control" name="formAddLibGroup" id="formAddLibGroup" required>
                            <?php foreach($db->getNomGroups() as $groups) echo "<option>".$groups."</option>\n";?>
                        </select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="formAddKeyUser" id="formKeyUserAdd">
					<button type="submit" class="btn btn-primary">Ajouter</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
