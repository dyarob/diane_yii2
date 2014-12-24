<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SerieClassLink */

$this->title = 'Create Serie Class Link';
$this->params['breadcrumbs'][] = ['label' => 'Serie Class Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="serie-class-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
