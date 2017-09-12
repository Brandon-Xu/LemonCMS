<?php

use source\core\grid\GridView;
use source\modules\fragment\models\Fragment;
use yii\helpers\Html;


/* @var $this source\core\back\BackView */
/* @var $searchModel source\modules\fragment\models\search\FragmentCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->toolbars([
    Html::a('新建', ['create'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, 'columns' => [
        ['class' => 'source\core\grid\IdColumn'], [
            'attribute' => 'name', 'width' => 'auto',
        ], [
            'attribute' => 'type', 'width' => '40px', 'content' => function ($model, $key, $index, $gridView) {
                return Fragment::getTypeItems($model->type);
            },
        ],

        ['class' => 'source\core\grid\ActionColumn'],
    ],
]); ?>


</div>
