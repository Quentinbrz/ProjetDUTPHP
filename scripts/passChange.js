$(document).ready(function() {
    $('input[type=password]').bind("cut copy paste", function(e) {
        e.preventDefault();
        alert("Vous ne pouvez pas copier coller dans ces champs.");
        $('input[type=password]').bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });
});