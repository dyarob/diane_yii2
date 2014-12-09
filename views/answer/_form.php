<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_student')->textInput() ?>

    <?= $form->field($model, 'id_problem')->textInput() ?>

    <?= $form->field($model, 'answer')->textInput(['maxlength' => 240]) ?>

    <?= $form->field($model, 'miscalc')->textInput() ?>

    <?= $form->field($model, 'correct')->textInput() ?>

    <?= $form->field($model, 'formul')->textInput(['maxlength' => 33]) ?>

    <?= $form->field($model, 'id_strategy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
