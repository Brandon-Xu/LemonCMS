<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this source\core\base\BaseView */
/* @var $searchModel app\modules\rbac\models\search\RelationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = '指派角色';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="relation-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id', 'username',

            [
                'class' => 'yii\grid\ActionColumn', 'template' => '{role}{view}{update} {delete}', 'buttons' => [
                'role' => function ($url, $model) {
                    return Html::a('设定角色', Url::to([
                        'role', 'user' => $model['username'],
                    ]));
                },
            ],
            ],
        ],
    ]); ?>

</div>
