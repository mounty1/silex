function ajaxResponse () {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("response").innerHTML = this.responseText;
	}
}

function jsend (verb) {
	const content = document.getElementById("request").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = ajaxResponse;
	xhttp.open(verb, content, true);
	xhttp.send();
}
