function showStudent(studt) {

	// New page elements declaration
	var mydiv = document.getElementById("txtHint");
	var title = document.createElement("h1");

	// New page elements filling
	title.innerHTML = studt.first_name;

	// New page creation
	mydiv.innerHTML = "";
	mydiv.appendChild(title);
}
