<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SerieClassLink */

$this->title = 'Update Serie Class Link: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Serie Class Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="serie-class-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
