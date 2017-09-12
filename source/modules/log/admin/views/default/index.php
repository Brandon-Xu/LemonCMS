<?php

use source\core\grid\GridView;


/* @var $this source\core\back\BackView */
/* @var $searchModel source\modules\log\models\search\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日志管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, 'columns' => [
        ['class' => 'source\core\grid\IdColumn'],

        'category',

        // 'message:ntext',
        [
            'attribute' => 'message', 'headerOptions' => ['width' => 'auto'],
        ],

        [
            'attribute' => 'log_time', 'value' => function ($data) {
            $time = intval($data['log_time']);

            return date('m-d H:i', $time);
        },
        ],

        'prefix:ntext', [
            'class' => 'source\core\grid\ActionColumn', 'template' => '{delete}', //'buttons' =>[
        ],
    ],
]); ?>



