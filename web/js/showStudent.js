function showStudent(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML="";
	return;
    }
    if (window.XMLHttpRequest) { // IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // IE5 & 6
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
	}
    }
    xmlhttp.open("GET", "phpscripts/getstudent.php?q=" + str, true);
    xmlhttp.send();
}
