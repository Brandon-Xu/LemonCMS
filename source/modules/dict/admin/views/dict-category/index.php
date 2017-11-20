<?php

use source\core\grid\GridView;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '字典';
$this->params['breadcrumbs'][] = $this->title;
$this->toolbar = [
    Html::a('新建', ['create'], ['class' => 'btn btn-primary']),
]; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'source\core\grid\TextIdColumn'],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'width' => '250px',
            'value' => function ($model, $key, $index, $column) {

                return Html::a($model->name, ['dict/index', 'category' => $model->id]);
            },
        ],
        [
            'attribute' => 'description',
            'width' => 'auto',
        ],

        ['class' => 'source\core\grid\ActionColumn'],
    ],
]); ?>