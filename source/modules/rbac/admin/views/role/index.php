<?php

use source\core\grid\GridView;
use source\libs\Resource;
use source\LuLu;
use source\modules\rbac\models\Role;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this source\core\front\FrontView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$categoryId = app()->request->get('category');

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;

$columns = [

    [
        'attribute' => 'id', 'width' => '120px;',
    ], [
        'attribute' => 'name', 'width' => '250px;',
    ],

    [
        'attribute' => 'description', 'width' => 'auto',
    ],

    [
        'class' => 'source\core\grid\ActionColumn',
        'template' => '{permission}{update} {delete}',
        'width' => '60px',
        'buttons' => [
            'permission' => function ($url, $model) {
                $iconUrl = \source\assets\AdminIconAssets::getBaseUrl();
                return Html::a('<img src="'.$iconUrl.'/icons/color/key.png">', Url::to([
                    'relation', 'role' => $model['id'],
                ]), [
                    'title' => '设置权限',
                ]);
            },
            'delete' => function ($url, $model) {
                if ($model->is_system) {
                    return '';
                }
                $iconUrl = \source\assets\AdminIconAssets::getBaseUrl();
                return Html::a('<img src="'.$iconUrl.'/icons/color/cross.png">', $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post', 'data-pjax' => '0',
                ]);
            },
        ],
    ],
];
?>

<?php $this->toolbars([
    Html::a('新建', [
        'create', 'category' => $categoryId,
    ], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>

<style>
    .ui-tabs .ui-tabs-panel {
        padding: 0px;
    }
</style>
<div class="da-ex-tabs">
    <ul>
        <!-- @todo
        <li><a href="#tabs-<?php echo Role::Category_Member ?>">会员角色</a></li>
        -->
        <li><a href="#tabs-<?php echo Role::Category_Admin ?>">管理员角色</a></li>
        <li><a href="#tabs-<?php echo Role::Category_System ?>">系统角色</a></li>
    </ul>
    <!--
    <div id="tabs-<?php echo Role::Category_Member ?>">
        <?= GridView::widget([
            'dataProvider' => $membersDataProvider, 'columns' => $columns,
        ]); ?>
    </div>
    -->
    <div id="tabs-<?php echo Role::Category_Admin ?>">
        <?= GridView::widget([
            'dataProvider' => $adminsDataProvider, 'columns' => $columns,
        ]); ?>
    </div>
    <div id="tabs-<?php echo Role::Category_System ?>">
        <?= GridView::widget([
            'dataProvider' => $systemsDataProvider, 'columns' => $columns,
        ]); ?>
    </div>
</div>
    
