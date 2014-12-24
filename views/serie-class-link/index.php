<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SerieClassLinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Serie Class Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="serie-class-link-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Serie Class Link', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_serie',
            'id_class',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
