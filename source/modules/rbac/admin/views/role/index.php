<?php

use source\core\grid\GridView;
use source\modules\rbac\models\Role;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this source\core\base\BaseView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$categoryId = app()->request->get('category');

$this->title = $this->t('Rule Manage');
$this->breadcrumbs = [
    $this->title,
];

$this->toolbar = [
    Html::a(Yii::t('app', 'Create'), ['create', 'category' => $categoryId], ['class' => 'btn btn-primary']),
];

$columns = [
    ['attribute' => 'id', 'width' => '120px;'],
    ['attribute' => 'name', 'width' => '250px;'],
    ['attribute' => 'description', 'width' => 'auto'],
    [
        'class' => 'source\core\grid\ActionColumn',
        'template' => '{permission} {update} {delete}',
        'buttons' => [
            'permission' => function ($url, $model) {
                return Html::a(\rmrevin\yii\fontawesome\FA::i('key'), Url::to([
                    'relation',
                    'role' => $model['id'],
                ]), [
                    'title' => Yii::t('yii', 'Role'),
                ]);
            },
            'delete' => function ($url, $model) {
                if ($model->is_system) {
                    return '';
                }

                return Html::a(\rmrevin\yii\fontawesome\FA::i('trash-o'), $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ]);
            },
        ],
    ],
];
?>


<div>
	<style>
		.ui-tabs .ui-tabs-panel {
		padding: 0;
	}
	</style>

	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs pull-right">
			<li class="active"><a href="#t1" data-toggle="tab" aria-expanded="true">管理员角色</a></li>
			<li class=""><a href="#t2" data-toggle="tab" aria-expanded="false">系统角色</a></li>
			<li class="pull-left header"><i class="fa fa-th"></i></li>
		</ul>
		<div class="tab-content no-padding">
			<div class="tab-pane active" id="t1">
                <?= GridView::widget([
                    'dataProvider' => $adminsDataProvider,
                    'columns' => $columns,
                    'tableOptions' => ['class' => 'table table-bordered no-margin'],
                    'layout' => "{items}"
                ]); ?>
			</div>
			<!-- /.tab-pane -->
			<div class="tab-pane" id="t2">
                <?= GridView::widget([
                    'dataProvider' => $systemsDataProvider,
                    'columns' => $columns,
                    'tableOptions' => ['class' => 'table table-bordered no-margin'],
                    'layout' => "{items}"
                ]); ?>
			</div>
			<!-- /.tab-pane -->
		</div>
		<!-- /.tab-content -->
	</div>
	<!--
        <div id="tabs-<?php echo Role::Category_Member ?>">
        <?= GridView::widget([
    'dataProvider' => $membersDataProvider,
    'columns' => $columns,
]); ?>
    </div>
    -->
</div>