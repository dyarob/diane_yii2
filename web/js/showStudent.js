function showStudent(studt) {

	// New page elements declaration
	var mydiv = document.getElementById("txtHint");
	var title = document.createElement("h1");
	var percent = document.createElement("div");
	var percent_correct = document.createElement("h2");
	var percent_bar = document.createElement("canvas");
	var percent_incorrect = document.createElement("h2");
	var content = document.createElement("div");

	// New page elements filling
	title.innerHTML = studt.s.first_name + ", " + studt.s.class;
	var i;
	var l = studt.a.length;
	var answers = new Array(l);
	var correct_num = 0;
	for (i = 0; i < l; ++i) {
		answers[i] = document.createElement("p");
		answers[i].innerHTML = studt.a[i].answer;
		content.appendChild(answers[i]);
		if (studt.a[i].correct === '1')
			++correct_num;
	}
	correct_num = correct_num * 100 / l;
	percent_correct.innerHTML = Math.round(correct_num) + "% correct";
	percent_correct.style.color = "green";
	percent_incorrect.innerHTML = Math.round(100 - correct_num) + "% incorrect";
	percent_incorrect.style.color = "red";
	percent_incorrect.style.textAlign = "right";
	var width = mydiv.clientWidth * 96 / 100;
	var ctx = percent_bar.getContext("2d");
	ctx.canvas.width = width;
	ctx.canvas.height = 10;
	ctx.fillStyle="green";
	ctx.fillRect(0,0,width * correct_num / 100,10);
	ctx.fillStyle="red";
	ctx.fillRect(width * correct_num / 100,0,width * (100 - correct_num) / 100,10);

	// New page creation
	mydiv.innerHTML = "";
	mydiv.appendChild(title);
	percent.appendChild(percent_correct);
	percent.appendChild(percent_bar);
	percent.appendChild(percent_incorrect);
	mydiv.appendChild(percent);
	mydiv.appendChild(content);
}
