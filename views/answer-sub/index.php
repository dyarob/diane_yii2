<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnswerSubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Answer Subs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-sub-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Answer Sub', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_answer',
            'id_op_typ',
            'id_resol_typ',
            'miscalc',
            // 'formul',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
