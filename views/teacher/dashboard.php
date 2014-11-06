<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<link rel="stylesheet" type="text/css" href="css/new.css">
<h1>Mes élèves</h1>
<hr />
<h3>Classe X</h3>
<hr />
<div class="contents">
<div class="column column-small">
	<ul>
		<?php foreach ($students as $student): ?>
		<li>
		<a href="<?= Url::base() ?>?r=teacher/student&first_name=<?= Html::encode("{$student->first_name}") ?>">
		<?= Html::encode("{$student->first_name}") ?>
		</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
<div class="column column-big">
	coucou
</div>
</div>
