function showStudent(studt) {

	// New page elements declaration
	var mydiv = document.getElementById("txtHint");
	var title = document.createElement("h1");
	var content = document.createElement("p");

	// New page elements filling
	title.innerHTML = studt.s.first_name + ", " + studt.s.class;
	//var tmp = studt.a['0'];
	var i;
	var l = studt.a.length;
	var answers = new Array(l);
	for (i = 0; i < l; ++i) {
		answers[i] = document.createElement("p");
		answers[i].innerHTML = studt.a[i].answer;
		content.appendChild(answers[i]);
	}

	// New page creation
	mydiv.innerHTML = "";
	mydiv.appendChild(title);
	mydiv.appendChild(content);
}
