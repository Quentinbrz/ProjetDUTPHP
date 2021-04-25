function changeSemaphore(idSeance) {
    let http = new XMLHttpRequest();
    let button = document.getElementById('buttonSema' + idSeance);
    http.onreadystatechange = function() {
        if (http.readyState === 4) {
            let newSema = JSON.parse(http.response);
            button.setAttribute('title', newSema.lib);
            button.setAttribute('style', "background-color : " + newSema.color + "; color : " + newSema.textcolor);
            unsetLoading(button);
        }
    };

    setLoading(button);
    let url = 'changeSemaphore.inc.php';
    let params = 'idSeance=' + idSeance;
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
}

function setLoading(element) {

    let divSpinner = document.createElement("div");
    let span = document.createElement("span");
    span.setAttribute("class", "sr-only");
    span.innerHTML = "Chargement";
    divSpinner.setAttribute("class", "spinner-border");
    divSpinner.setAttribute("role", "status");
    divSpinner.appendChild(span);
    element.appendChild(divSpinner);
    element.toggleAttribute('disabled', true);

}

function unsetLoading(element) {

    element.removeChild(element.childNodes[1]);
    element.toggleAttribute('disabled', false);

}