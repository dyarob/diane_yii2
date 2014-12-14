<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<script type="text/javascript" src="js/series_class.js"></script>
<link rel="stylesheet" type="text/css" href="css/new.css">
<h1>Gestion des series de problemes</h1>
<hr />
<div class="contents">
<div class="column column-small">
	<ul>

		<?php
		// ====================================
		foreach ($classes as $class):
		// ====================================
		?>

		<li>
		<p onclick="showStudent(<?= Html::encode(json_encode(
			//$class->attributes
			array('c' => $class->attributes,
				  's' => $class->series)
				)) ?>)">
			<?= Html::encode("{$class->name}") ?>
			<?= Html::encode("{$class->year}") ?>
		</p>
		</li>
		<?php endforeach; ?>

	</ul>
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
<div class="column column-big" id="txtHint">
	<p>Sélectionnez une classe pour lui affecter des séries de problèmes.</p>

	<?php $form = ActiveForm::begin();
	foreach ($series as $serie):
	?>
		<?= Html::checkbox($serie->name, false) ?>
	<?php endforeach;
	ActiveForm::end(); ?>
</div>
</div>
