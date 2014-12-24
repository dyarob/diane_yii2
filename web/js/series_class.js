function showSeries(clas) {

	document.forms['form'].elements['id_class'].value =
	clas.c.id;

	$("input:checkbox").attr('checked', false);
	var l = clas.s.length;
	var i;
	for (i=0; i<l; ++i) {
		document.forms['form'].elements[clas.s[i].name].checked = true;
	}

	// New page elements declaration
	//var mydiv = document.getElementById("txtHint");
	//var title = document.createElement("h1");
	/*
	var percent = document.createElement("div");
	var percent_correct = document.createElement("h2");
	var percent_bar = document.createElement("canvas");
	var percent_incorrect = document.createElement("h2");
	var content = document.createElement("div");
	*/

	// New page elements filling
	//title.innerHTML = clas.c.name;
	//title.innerHTML += clas.s[0].name;

	/*
	var i; // main loop counter
	var i2; // main loop counter * 2
	var j; // subanswers counter
	// array of html elements containing the answers:
	// answers => graphical html element
	// studt.a[] => data (with one on two counter)
	var answers = new Array(l); 
	// nbr of correct answers for percent display:
	var correct_num = 0;
	// nbr of intermediary calculation
	var calc_num = 0;
	var expl_num = 0;
	var ment_num = 0;
	// ATTENTION: ONE ENTRY ON TWO IS AN ANSWER,
	// THE OTHER IS AN ARRAY OF SUBANSWERS.
	var l = studt.a.length / 2;

	// answers filling with diagnostic for each answer
	for (i = 0, i2 = 0; i < l; ++i, i2+=2) {
		answers[i] = document.createElement("p");
		answers[i].innerHTML = "<hr />Réponse fournie : « " + studt.a[i*2].answer + " »";
		if (studt.a[i2].correct === '1') {
			answers[i].innerHTML += " (bonne réponse) <br />";
			++correct_num;
		} else {
			answers[i].innerHTML += " (mauvaise réponse) <br />";
		}
		answers[i].innerHTML += studt.s.first_name;
		calc_num = studt.a[i2 + 1].length;
		ment_num = 0;
		expl_num = 0;
		for (j = 0; j < calc_num; ++j) {
			if (studt.a[i2+1][j].id_resol_typ == "6")
				++ment_num;
			else
				++expl_num;
		}

		// Si la reponse ne contient aucun calcul
		if(!calc_num)
			answers[i].innerHTML+= " n'a pas répondu à la question.";
		// Sinon, on inscrit le diagnostic complet
		else {
			answers[i].innerHTML += " a procédé de la manière suivante :<br />";
			answers[i].innerHTML += "Sa résolution s'est faîte en " +
				expl_num +
				((expl_num > 1)?
					" calculs explicites":
					" calcul explicite");
			if (ment_num >= 1)
				answers[i].innerHTML += " et " + ment_num +
					((ment_num > 1)?
						" calculs mentaux":
						" calcul mental");
			answers[i].innerHTML += ".<br />";
			// diagnostic / sub answer
			for (j = 1; j <= calc_num; ++j)
				answers[i] = append_subanswer_diag(answers[i],
									calc_num, studt.a[i2+1][j-1],
									studt.s.first_name, j);
		}
		content.appendChild(answers[i]);
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
*/
	// New page creation
	//mydiv.innerHTML = "";
	//mydiv.appendChild(title);
}
	/*
	percent.appendChild(percent_correct);
	percent.appendChild(percent_bar);
	percent.appendChild(percent_incorrect);
	mydiv.appendChild(percent);
	mydiv.appendChild(content);
}

function append_subanswer_diag(answer_node, calc_num, subanswer_arr, first_name, j)
{
	answer_node = append_which_calcul(answer_node, j, calc_num);
	answer_node.innerHTML += " a été ";
	answer_node = append_op_typ(answer_node, subanswer_arr);
	answer_node.innerHTML += " sous la forme d'";
	answer_node = append_resol_typ(answer_node, subanswer_arr);
	answer_node.innerHTML += ". ";
	answer_node = append_miscalc(answer_node,
							subanswer_arr.miscalc,
							first_name);
	answer_node.innerHTML += "<br />";
	return (answer_node);
}

function append_which_calcul(subanswer_node, j, calc_num)
{
	if (j == 1) {
		if (calc_num == 1)
			subanswer_node.innerHTML += "Son calcul";
		else
			subanswer_node.innerHTML += "Son premier calcul";
	}
	else if (j == 2) 
		subanswer_node.innerHTML += "Son deuxième calcul";
	else if (j == 3) 
		subanswer_node.innerHTML += "Son troisième calcul";
	else if (j == 3)
		subanswer_node.innerHTML += "Son troisième calcul";
	else if (j >= 4)
		subanswer_node.innerHTML += "Son calcul n°" + j;
	return (subanswer_node);
}

function append_resol_typ(subanswer_node, subanswer_arr)
{
	switch (subanswer_arr.id_resol_typ) {
		case "1":
			subanswer_node.innerHTML += "une soustraction inverse";
			break;
		case "2":
			subanswer_node.innerHTML += "une opération simple";
			break;
		case "3":
			subanswer_node.innerHTML += "une addition à trou";
			break;
		case "4":
			subanswer_node.innerHTML += "une soustraction à trou";
			break;
		case "5":
			subanswer_node.innerHTML += "une opération ininterprétable";
			break;
		case "6":
			subanswer_node.innerHTML += "une opération mentale inconnue";
			break;
		default:
			subanswer_node.innerHTML += "une opération ininterprétable";
	}
	return (subanswer_node);
}

function append_op_typ(subanswer_node, subanswer_arr)
{
	switch (subanswer_arr.op) {
		case "+":
			subanswer_node.innerHTML += "une addition";
			break;
		case "-":
			subanswer_node.innerHTML += "une soustraction";
			break;
		case "*":
			subanswer_node.innerHTML += "une multiplication";
			break;
		case "/":
			subanswer_node.innerHTML += "une division";
			break;
		case "%":
			subanswer_node.innerHTML += "un modulo";
			break;
		default:
			subanswer_node.innerHTML += "une opération ininterprétable";
	}
	return (subanswer_node);
}

function append_miscalc(subanswer_node, miscalc, first_name)
{
	if (miscalc > 0) {
		subanswer_node.innerHTML += first_name
			+ " a effectué une erreur de calcul de "
			+ miscalc + " sur cette opération.";
	}
	return (subanswer_node);
}
*/
