<?php
//Vérification des paramètres avant l'ajout
if(isset($_POST['formAddIdModuleSeance'])){
	if(!empty($_POST['formAddIdModuleSeance']) AND !empty($_POST['formAddIdTypeSeance']) AND !empty($_POST['formAddIdGroupSeance'] AND !empty($_POST['formAddDateSeance']))){
		$key_user=$_SESSION['Client']->getKeyUser();
		$id_module=$db->getModuleWithLib($_POST['formAddIdModuleSeance'])->getId_Module();
		$db->insertSeance($id_module,$_POST['formAddDateSeance'],$_POST['formAddIdTypeSeance'],$_POST['formAddIdGroupSeance'],$key_user);
	}else{
		//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
		echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
	}
}
?>

<div class="modal fade" id="modalAddSeance" tabindex="-1" role="dialog" aria-labelledby="modalAddSeanceLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="modalAddSeance">Ajout d'une séance</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="hidden">
			  <span aria-hidden="true">&times;</span>
			</button>
			</div>
			<form action="index.php" method="post">
				<div class="modal-body">
					<div class="form-group row ">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="addIdModuleSeance">Module</label><br/>
							<select class="form-control" name="formAddIdModuleSeance" id="formAddIdModuleSeance">
								<?php

									foreach($db->getModulesOfUser($_SESSION['Client']->getKeyUser()) as $module){
										//Pour gérer les options disponible en fonction des rôles
										if(in_array($module->getIdRoleModule(),$db->getRoles($_SESSION['Client']->getKeyUser())))
											echo "<option>".$module->getLibModule()."</option>\n";
									}
								?>
							</select>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row ">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="addIdModuleSeance">Type de séance</label>
							<select class="form-control" name="formAddIdTypeSeance" id="addIdModuleSeance">
								<?php
									foreach($db->getTypesSeance() as $seance){
									//Pour gérer les options disponible en fonction des rôles
										if(in_array($seance->getIdRoleTS(),$db->getRoles($_SESSION['Client']->getKeyUser())))
											echo "<option>".$seance->getLib()."</option>\n";
									}
								?>
							</select>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="addIdGroupSeance">Groupe</label>
							<select class="form-control" name="formAddIdGroupSeance" id="addIdGroupSeance">
								<?php foreach($db->getGroupsOfUser($_SESSION['Client']->getKeyUser()) as $group) echo "<option>".$group->getNom()."</option>\n";?>
							</select>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="addDateSeance">Date</label>
							<input type="date" class="form-control darkModeInput" name="formAddDateSeance" id="addDateSeance" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-primary">Ajouter la séance</button>
				</div>
			</form>
		</div>
	</div>
</div>
