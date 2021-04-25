<?php

//Vérification des paramètres avant la modification
if(isset($_POST['formEditIdEvent'])){
	if(!empty($_POST['formEditIdEvent']) AND !empty($_POST['formEditIdSeanceEvent']) AND !empty($_POST['formEditTypeEvent']) AND !empty($_POST['formEditLibEvent'])){
		//Update dans la bdd
		$db->changeEvent($_POST['formEditIdEvent'],$_POST['formEditIdSeanceEvent'],$_POST['formEditTypeEvent'],$_POST['formEditLibEvent'],$_POST['formEditDureeEvent'],$_POST['formEditDateFinEvent']);
	}else{
		//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
		echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
	}
}


?>

<div class="modal fade" id="modalEditEvent" tabindex="-1" role="dialog" aria-labelledby="modalEventLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			    <h5 class="modal-title" id="modalEventLabel">Modification d'un événement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
			    </button>
			</div>
			<form action="index.php" method="post" id="formHrefActionEditEvent">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="formEditIdEvent" id="formEditIdEvent">
						<input type="hidden" name="formEditIdSeanceEvent" id="formEditIdSeanceEvent">
					</div>
                    <div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditTypeEvent">Changer type de l'événement</label><br/>
							<select class="form-control" name="formEditTypeEvent" id="formEditTypeEvent">
								<?php foreach($db->getTypeEvent() as $typeEvent)
								//Pour gérer les options disponible en fonction des rôles
								if(in_array($typeEvent->getIdRoleEvent(),$db->getRoles($_SESSION['Client']->getKeyUser())))
									echo "<option>".$typeEvent->getLibTypeEvent()."</option>\n";?>
					        </select>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditLibEvent">Changer le libellé</label><br/>
							<input type="text" class="form-control darkModeInput" name="formEditLibEvent" id="formEditLibEvent" maxlength="90" required>
						</div>
						<div class="col-3"></div>
					</div>
					<div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditDureeEvent">Changer la durée</label><br/>
							<input type="time" class="form-control darkModeInput" name="formEditDureeEvent" id="formEditDureeEvent" >
						</div>
						<div class="col-3"></div>
					</div>
                    <div class="form-group row">
						<div class="col-3"></div>
						<div class="col-6">
							<label for="formEditDateFinEvent">Changer la date de fin </label><br/>
							<input type="date" class="form-control darkModeInput" name="formEditDateFinEvent" id="formEditDateFinEvent">
						</div>
						<div class="col-3"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Modifier l'événement'</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				</div>
			</form>
		</div>
	</div>
</div>
