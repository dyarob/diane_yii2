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
			print_r($teacher->clas);
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
		<?php endforeach; ?>

	</ul>
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
<div class="column column-big" id="txtHint">
	<p>Sélectionnez un élève pour voir son resumé</p>
</div>
</div>
