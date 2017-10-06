<?php

use source\core\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this source\core\front\FrontView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->addBreadcrumbs([
    $this->title,
]);


?>
<?php $this->toolbars([
    Html::a('新建', ['create'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>


<?= GridView::widget([
    'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}", 'columns' => [
        [
            'class' => 'source\core\grid\TextIdColumn',
        ], [
            'attribute' => 'name', 'format' => 'raw', 'width' => '250px',
            'value' => function ($model, $key, $index, $column) {

                return Html::a($model->name, ['taxonomy/index', 'category' => $model->id]);
            },
        ], [
            'attribute' => 'description', 'width' => 'auto',
        ], [
            'class' => 'source\core\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'view' => function ($url, $model, $key, $index, $column) {

                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to([
                        'taxonomy/index', 'category' => $key,
                    ]), [
                        'title' => Yii::t('yii', 'View'), 'data-pjax' => '0',
                    ]);
                },
            ],
        ],
    ],
]); ?>


