<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SerieClassLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="serie-class-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_serie')->textInput() ?>

    <?= $form->field($model, 'id_class')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
