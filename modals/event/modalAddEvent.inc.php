<?php
require ('upload.php');

//Vérification des paramètres avant l'ajout
if(isset($_POST['formAddIdSeanceEvent'])){
	if(!empty($_POST['formAddIdSeanceEvent']) AND !empty($_POST['formAddTypeEvent']) AND !empty($_POST['formAddLibEvent'])){
		$seance = $db->getSeanceById($_POST['formAddIdSeanceEvent']);
		$arrayFile = reArrayFiles($_FILES['formAddAttachementEvent']);
		//Insertion dans la bdd
		$db->insertEvent($_POST['formAddIdSeanceEvent'],$_POST['formAddTypeEvent'],$_POST['formAddLibEvent'],$_POST['formAddDureeEvent'],$_POST['formAddDateFinEvent'],$_SESSION['Client']->getKeyUser());
		//Stocker la pièce jointe
		uploadFileSeance($arrayFile,substr($seance->getDateTime(), 0,4 ),substr($seance->getDateTime(), 5,2 ),$_POST['formAddIdSeanceEvent'],$db->getLastInsertedId());
	}else{
		//Pop-up pour prévenir d'une erreur dans la saisie des paramètres
		echo '<div class="alert alert-danger"> Un des paramètres était manquant <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button></div>';
	}
}
?>

<div class="modal fade" id="modalAddEvent" tabindex="-1" role="dialog" aria-labelledby="modalAddSeanceLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="modalAddEvent">Ajout d'un événement</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="hidden">
			  <span aria-hidden="true">&times;</span>
			</button>
			</div>
			<form id="formHrefActionAddEvent" method="post" enctype="multipart/form-data">
				<input type="hidden" name="formAddIdSeanceEvent" id="formAddIdSeanceEvent" required>
				<div class="modal-body">
					<div class="form-group row ">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="formAddTypeEvent">Type d'évenement</label>
							<select class="form-control" name="formAddTypeEvent" id="formAddTypeEvent">
								<?php foreach($db->getTypeEvent() as $typeEvent)
								//Pour gérer les options disponible en fonction des rôles
								if(in_array($typeEvent->getIdRoleEvent(),$db->getRoles($_SESSION['Client']->getKeyUser())))
									echo "<option>".$typeEvent->getLibTypeEvent()."</option>\n";?>
							</select>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row ">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="formAddLibEvent">Libellé de l'événement</label><br/>
							<input type="text" class="form-control darkModeInput" name="formAddLibEvent" id="formAddLibEvent" maxlength="90" required>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10" id="divAttachment">
							<label for="formAddAttachementEvent0">Pièce jointes</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="formAddAttachementEvent0" name="formAddAttachementEvent[]">
								<label class="custom-file-label" for="formAddAttachementEvent0" data-browse="Parcourir">Ajouter une pièce jointe</label>
							</div>
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="formAddDureeEvent">Durée</label><br/>
							<input type="time" class="form-control darkModeInput" name="formAddDureeEvent" id="formAddDureeEvent">
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
					<div class="form-group row">
						<div class="col-3-xl col-1"></div>
						<div class="col-6-xl col-10">
							<label for="formAddDateFinEvent">Date de fin</label><br/>
							<input type="date" class="form-control darkModeInput" name="formAddDateFinEvent" id="formAddDateFinEvent">
						</div>
						<div class="col-3-xl col-1"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-primary">Ajouter l'événement</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>

nbAttachmentInput = 0

$('*').change(function(e){
	if(e.currentTarget.classList.contains('form-group') && e.target.classList.contains('custom-file-input')){
		let fileName = e.target.files[0].name;
		e.target.nextElementSibling.innerHTML = fileName;
		addButtonAttachment();
	}
});

function addButtonAttachment(){
	nbAttachmentInput++
	if(nbAttachmentInput < <?php echo $db->getNbPieceJointeMax() ?>){
		let colPiecesJointes = document.getElementById('divAttachment');
		let div = document.createElement("div");
		div.setAttribute('class',"custom-file");
		let input = document.createElement("input");
		input.type = "file"; input.setAttribute('class',"custom-file-input"); input.name = "formAddAttachementEvent[]"; input.id = "formAddAttachementEvent"+nbAttachmentInput;
		let label = document.createElement("label");
		label.setAttribute('class',"custom-file-label"); label.setAttribute('for',"formAddAttachementEvent"+nbAttachmentInput);  label.setAttribute('data-browse',"Parcourir"); label.innerHTML = "Ajouter une pièce jointe";
		div.appendChild(input); div.appendChild(label);
		colPiecesJointes.appendChild(div);
	}
}

</script>
