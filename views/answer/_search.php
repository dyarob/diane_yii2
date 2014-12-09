<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_student') ?>

    <?= $form->field($model, 'id_problem') ?>

    <?= $form->field($model, 'answer') ?>

    <?= $form->field($model, 'miscalc') ?>

    <?php // echo $form->field($model, 'correct') ?>

    <?php // echo $form->field($model, 'formul') ?>

    <?php // echo $form->field($model, 'id_strategy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
