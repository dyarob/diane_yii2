<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerSub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-sub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_answer')->textInput() ?>

    <?= $form->field($model, 'id_resol_typ')->textInput() ?>

    <?= $form->field($model, 'miscalc')->textInput() ?>

    <?= $form->field($model, 'formul')->textInput(['maxlength' => 33]) ?>

    <?= $form->field($model, 'str')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
