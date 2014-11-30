<?php
use app\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Student */
$_SESSION = Yii::$app->session;
?>

<div class="student-chooseserie">
<h1>Choisis ta serie de problemes :</h1>
<hr />
<?php $form = ActiveForm::begin(); ?>
<ul>

<?php foreach($_SESSION['student']->series as $serie): ?>
	<li>
	<?= Html::submitButton($serie['name'], [
			'class' => 'btn btn-primary',
			'name' => $serie['name']
			]) ?>
	</li>
	<hr />
<?php endforeach; ?>

</ul>
<?php ActiveForm::end(); ?>
</div>
