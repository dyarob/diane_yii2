<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerSubSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-sub-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_answer') ?>

    <?= $form->field($model, 'id_op_typ') ?>

    <?= $form->field($model, 'id_resol_typ') ?>

    <?= $form->field($model, 'miscalc') ?>

    <?php // echo $form->field($model, 'formul') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
