<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $searchModel source\models\search\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider, 'filterModel' => $searchModel, 'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id', 'reply_ids', 'content_id', 'user_id', 'user_name', // 'user_email:email',
            // 'user_url:url',
            // 'user_ip',
            // 'user_address',
            // 'content:ntext',
            // 'created_at',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
