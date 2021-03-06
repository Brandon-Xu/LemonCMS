<?php

use source\core\grid\GridView;
use source\LuLu;
use source\modules\fragment\models\Fragment;
use yii\helpers\Html;


/* @var $this source\core\base\BaseView */
/* @var $searchModel source\modules\fragment\models\search\Fragment1DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$fid = app()->request->get('fid');

$fragmentModel = Fragment::findOne(['id' => $fid]);

$this->title = $fragmentModel->name.'(代码碎片)';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->toolbar = [
    Html::a('返回', ['fragment/index', 'type' => 1], ['class' => 'btn btn-default']),
    Html::a('新建', ['create', 'fid' => $fid], ['class' => 'btn btn-default']),
]; ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, 'columns' => [
        ['class' => 'source\core\grid\IdColumn'],

        [
            'attribute' => 'title', 'width' => 'auto', 'value' => function ($model, $key, $index, $column) {
            return Html::a($model->title, [
                'fragment1-data/update', 'id' => $model->id, 'type' => 1, 'fid' => $model->fragment_id,
            ]);
        },
        ], [
            'attribute' => 'content', 'width' => '200px', 'value' => function ($model, $key, $index, $column) {
                $str = $model->content ? '<div style="overflow:hidden;width:200px;height:120px;">'.Html::decode($model->content).'</div>' : '';

                return $str;
            },
        ], [
            'class' => 'source\core\grid\DateTimeColumn', 'attribute' => 'created_at',
        ], ['class' => 'source\core\grid\SortColumn'], ['class' => 'source\core\grid\StatusColumn'],
        ['class' => 'source\core\grid\ActionColumn'],
    ],
]); ?>