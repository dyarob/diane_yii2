<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form ActiveForm */
?>
<div class="student-entry">

	<h1>Bienvenue sur DIANE !</h1>
	<h2>Entre ton prénom et ta classe :</h2>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'first_name') ?>
		<?= $form->field($model, 'id_class')
				->dropDownList(['1' => 'CE2', '2' => 'CM1', '3' => 'CM1-2']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- student-entry -->
