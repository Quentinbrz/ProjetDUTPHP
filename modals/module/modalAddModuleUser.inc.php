<?php
//Vérification des paramètres avant l'ajout
	if(isset($_POST['formAddLibModule'])){
		if(!empty($_POST['formAddKeyUser']) AND !empty($_POST['formAddLibModule'])){
			$db->addModuleToUser($_POST['formAddKeyUser'],$_POST['formAddLibModule']);
		}else{
			//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
			echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
		}

	}
?>

<div class="modal fade" id="modalAddModUser" tabindex="-1" role="dialog" aria-labelledby="modalModuleLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEditLabel">Ajout d'un module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="editModulesUser.php" method="post">
				<div class="modal-body">
					<div class="form-group">
                        <label for="formAddLibModule">Module</label>
                        <select class="form-control" name="formAddLibModule" id="formAddLibModule" required>
                            <?php foreach($db->getModules() as $module){?> <option value="<?php echo $module->getLibModule();?>"> <?php echo $module->getLibModule()." (".$module->getCodeModule().")";?></option> <?php echo"\n"; }?>
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
