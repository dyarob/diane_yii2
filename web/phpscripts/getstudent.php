<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use yii\db\Query;

$q = intval($_GET['q']);

$queryAS = (new Query())
    ->select('*')
    ->from('answer_series')
    ->where(['id_student' => $q]);
$pagination = new Pagination([
    'defaultPageSize' => 10,
    'totalCount' => $query->count(),
    ]);
$myAS = $query->offset($pagination->offset)
    ->limit($pagination->limit)
    ->all();

$queryPS = (new \yii\db\Query())
    ->select('*')
    ->from('problem_series');
$myPS = $queryPS->all();
?>

<ul>
    <?php foreach ($myPS as $PS):
        foreach ($myPA as $PA):
	    if ($PS['id'] == $PA['id_problem_serie']): ?>
	    <li>
	    	<?= Html::encode("{$PS->name}") ?>
	    </li>
	    <?php endif;
        endforeach;
    endforeach; ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</ul>
