<?php

use source\core\grid\GridView;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $searchModel source\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Manage');
$this->breadcrumbs = [ $this->title ];
$this->toolbar = [
    Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary']),
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        [ 'class' => 'source\core\grid\IdColumn' ],
        [ 'attribute' => 'username', 'width' => 'auto' ],
        [ 'attribute' => 'email', 'width' => '220px' ],
        [
            'class' => 'source\core\grid\DateTimeColumn',
            'attribute' => 'created_at',
        ],
        ['class' => 'source\core\grid\StatusColumn'],
        ['class' => 'source\core\grid\ActionColumn'],
    ],
]);