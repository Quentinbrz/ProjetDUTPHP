<?php
//Vérification des paramètres avant l'ajout
if(isset($_POST['formAddNomGroup'])){
	if(!empty($_POST['formAddNomGroup'])){
		if(!empty($_POST['formAddIdGroupPere'])){ $group_pere= $db->getGroupWithNom($_POST['formAddIdGroupPere']); $db->insertGroup($_POST['formAddNomGroup'],$group_pere->getId());}
		else $db->insertGroup($_POST['formAddNomGroup'],NULL);
	}else{
		//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
		echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
	}

}
?>

<div class="modal fade" id="modalAddGroup" tabindex="-1" role="dialog" aria-labelledby="modalGroupLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title text-center" id="modalAddGroup">Ajouter un nouveau Groupe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="formAddNomGroup">Nom du groupe</label>
							<input type="text" class="form-control darkModeInput" name="formAddNomGroup" id="formAddNomGroup" maxlength="10" required autofocus>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
                    <div class="form-group row">
                        <div class="col-3-xl col-1"></div>
                        <div class="col-6-xl col-10">
                            <label for="formAddIdGroupPere">Groupe père</label>
                            <select class="form-control" name="formAddIdGroupPere" id="formAddIdGroupPere">
                                <?php foreach($db->getNomGroups() as $groups) echo "<option>".$groups."</option>\n";?>
                            </select>
                        </div>
                        <div class="col-3-xl col-1"></div>
                    </div>
					<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Ajouter le groupe</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
				</div>
			</form>
		</div>
	</div>
</div>
