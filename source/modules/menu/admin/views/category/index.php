<?php

use source\core\grid\GridView;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->t('Menu Categories');
$this->breadcrumbs = [
    $this->title
];
$this->toolbar = [
    Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary']),
];
\yii\widgets\Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'source\core\grid\TextIdColumn'],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'width' => '250px',
            'value' => function ($model, $key, $index, $column) {
                return Html::a($model->name, ['menu/index', 'category' => $model->id]);
            },
        ],
        [
            'attribute' => 'description',
            'width' => 'auto',
        ],
        [
            'class' => 'source\core\grid\ActionColumn',
            'template' => '{update}',
        ],
    ],
]);
\yii\widgets\Pjax::end();