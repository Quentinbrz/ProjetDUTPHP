$('#modalEditUser').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    //Récupération des données des boutons
    let keyUser = button.data('formkeyuser');
    let idUser = button.data('formiduser');
    let nomUser = button.data('formnomuser');
    let prenomUser = button.data('formprenomuser');
    let isAdmin = button.data('formisadmin');
    let isEnseignant = button.data('formisenseignant');
    let isTuteur = button.data('formistuteur');

	//Envoi les données au modal pour avoir la valeur pré-rempli
    document.getElementById('formEditKeyUser').value = keyUser;
    document.getElementById('formEditIdUser').value = idUser;
    document.getElementById('formEditNomUser').value = nomUser;
    document.getElementById('formEditPrenomUser').value = prenomUser;
    document.getElementById('formEditCheckboxA').checked = isAdmin;
    document.getElementById('formEditCheckboxE').checked = isEnseignant;
    document.getElementById('formEditCheckboxT').checked = isTuteur;
    document.getElementById('modifModuleHref').href = '/PromInfo/settings/editModulesUser.php?keyUser='.concat(keyUser);
    document.getElementById('modifGroupeHref').href = '/PromInfo/settings/editGroupsUser.php?keyUser='.concat(keyUser);
});


$('#modalEditUser').on('hide.bs.modal', function (event) {
    cancelResetPass();
    window.history.pushState("object or string", "Title", "/PromInfo/settings/editUser.php");
});

function showDelUser(coKeyUser,keyUser){
    if(coKeyUser === keyUser){ $('#modalErrorDelUser').modal('show'); return false;}
    else{
	   document.getElementById('formDelIdUser').value = keyUser;
	   $('#modalDeleteUser').modal('show');
    }
}

window.onpopstate = function(e){
    if(e.state){
	   window.history.pushState("object or string", "Title", "/PromInfo/settings/editUser.php");
    }
};

function searchInTable() {
    let td, i, txtValue;
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("tableUser");
    let tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
	   td = tr[i].getElementsByTagName("td")[0];
	   if (td) {
		  txtValue = td.textContent || td.innerText;
		  if (txtValue.toUpperCase().indexOf(filter) > -1) {
			 tr[i].style.display = "";
		  } else {
			 tr[i].style.display = "none";
		  }
	   }
    }
}
