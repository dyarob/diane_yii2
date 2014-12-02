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
		// ====================================
		?>

		<li>
		<p onclick="showStudent(<?= Html::encode(json_encode(
			array('s' => $student->attributes,
				  'a' => $student->answers)
				)) ?>)">
			<?= Html::encode("{$student->first_name}") ?>
			<?= Html::encode("{$student->clas->name}") ?>
		</p>
		</li>
	<?php
		print_r($student->answers);
		if ($student->answers)
		{
		preg_match_all("/\d+\s*[+*-\/]\s*\d+\s*=\s*\d+/",
			$student->answers[0]['answer'], $simpl_formulas, PREG_SET_ORDER);
		print_r($simpl_formulas);
		}
	?>
		<?php endforeach; ?>

	</ul>
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
<div class="column column-big" id="txtHint">
	<p>Sélectionnez un élève pour voir son resumé</p>
</div>
</div>
