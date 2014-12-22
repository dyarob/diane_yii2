<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<script type="text/javascript" src="js/showStudent.js"></script>
<link rel="stylesheet" type="text/css" href="css/new.css">
<h1>Mes élèves</h1>
<hr />
<h3>Classe X</h3>
<hr />
<div class="contents">
<div class="column column-small">
	<ul>

	<?php
	// ====================================
	foreach ($students as $student):
		// Getting answers in an array to be converted to json
		$answers = array();
		// THERE IS ONE ENTRY IN TWO FOR THE ANSWER
		//							 FOR ITS SUBANSWERS
		foreach($student->answers as $answer):
			array_push($answers, $answer->attributes);
			array_push($answers, $answer->subanswers);
		endforeach;
		// ====================================
		?>

		<li>
		<p onclick="showStudent(<?= Html::encode(json_encode(
			array('s' => $student->attributes,
				  'a' => $answers
			 	  )
				)) ?>)">
			<?= Html::encode("{$student->first_name}") ?>
			<?= Html::encode("{$student->clas->name}") ?>
		</p>
		</li>
		<?php endforeach; ?>

	</ul>
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
<div class="column column-big" id="txtHint">
	<p>Sélectionnez un élève pour voir son resumé</p>
</div>
</div>
