<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Problem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="problem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_serie')->textInput() ?>

    <?= $form->field($model, 'statement')->textInput(['maxlength' => 600]) ?>

    <?= $form->field($model, 'properties')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'numbers')->textInput(['maxlength' => 40]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
