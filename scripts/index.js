$('#modalDeleteSeance').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	//Récupération des données des boutons
	var idSeance = button.data('idseance')

	//Envoi les données au modal pour avoir la valeur pré-rempli
	document.getElementById('formDelIdSeance').value = idSeance
})

$('#modalAddEvent').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	//Récupération des données des boutons
	var idSeance = button.data('idseance')
	var numSemaine = button.data('numsemaine');

	//Envoi les données au modal pour avoir la valeur pré-rempli
	document.getElementById('formHrefActionAddEvent').action = "index.php?semaine=".concat(numSemaine).concat('&seance=').concat(idSeance);
	document.getElementById('formAddIdSeanceEvent').value = idSeance;
})

$('#modalDeleteEvent').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	//Récupération des données des boutons
	var idEvent = button.data('idevent')
	var idSeance = button.data('idseance')
	var numSemaine = button.data('numsemaine');

	//Envoi les données au modal pour avoir la valeur pré-rempli
	document.getElementById('formHrefActionAddEvent').action = "index.php?semaine=".concat(numSemaine).concat('&seance=').concat(idSeance)
	document.getElementById('formDelIdEvent').value = idEvent
})

$('#modalEditEvent').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    //Récupération des données des boutons
    let idEvent = button.data('idevent');
    let idSeance = button.data('idseance');
    let type = button.data('typeevent');
    let lib = button.data('libevent');
    let duree = button.data('duree');
    let dateFin = button.data('datefin');
	let numSemaine = button.data('numsemaine');

	//Envoi les données au modal pour avoir la valeur pré-rempli
	document.getElementById('formHrefActionEditEvent').action = "index.php?semaine=".concat(numSemaine).concat('&seance=').concat(idSeance);
    document.getElementById('formEditIdEvent').value = idEvent;
    document.getElementById('formEditIdSeanceEvent').value = idSeance;
    document.getElementById('formEditTypeEvent').value = type;
    document.getElementById('formEditLibEvent').value = lib;
    document.getElementById('formEditDureeEvent').value = duree;
    document.getElementById('formEditDateFinEvent').value = dateFin;
});
