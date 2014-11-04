<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */
/* @var $form ActiveForm */
?>
<div class="teacher-signup">
    <h1>Création d'un compte Enseignant</h1>
    <p>Merci de compléter les champs suivants afin de vous enregistrer :<br /></p>
	<hr />
    <?php $form = ActiveForm::begin([
        'id' => 'signup-form',
	'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
	    ],
	]); ?>

        <?= $form->field($model, 'nom') ?>
        <?= $form->field($model, 'prenom') ?>
	<hr />
        <?= $form->field($model, 'login') ?>
        <?= $form->field($model, 'password',
            ['labelOptions'=>['label'=>'Mot de passe']]
	)->passwordInput() ?>
        <?= $form->field($model, 'repeatpassword',
            ['labelOptions'=>['label'=>'Retapez votre mot de passe']]
	    )->passwordInput() ?>
    
	<hr />
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('S\'enregistrer', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- teacher-signup -->
