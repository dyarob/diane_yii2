<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnswerSub */

$this->title = 'Update Answer Sub: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Answer Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="answer-sub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
