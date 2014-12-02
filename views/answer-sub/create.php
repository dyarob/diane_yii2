<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AnswerSub */

$this->title = 'Create Answer Sub';
$this->params['breadcrumbs'][] = ['label' => 'Answer Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-sub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
