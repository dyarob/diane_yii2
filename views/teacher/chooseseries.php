<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
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
		<p onclick="showSeries(<?= Html::encode(json_encode(
			array('c' => $class->attributes,
				  's' => $class->series)
				)) ?>)">
<?php print_r($class->series); ?>
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

	<?php $form = ActiveForm::begin(
		['options' => [
			'name' => 'form'
		]]);?>
	<?= Html::hiddenInput('id_class', '') ?>
	<?php
	foreach ($series as $serie):
	?>
		<?= Html::checkbox($serie->name, false) ?>
		<?php
		echo $serie->name;
		?>
		<br />
	<?php endforeach; ?>
	<br />
	<?= Html::submitButton('Enregistrer', [
			'class' => 'btn btn-primary',
			//'name' => $serie['name']
			]) ?>
	<?php ActiveForm::end(); ?>
</div>
</div>
