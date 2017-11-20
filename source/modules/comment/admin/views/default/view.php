<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\comment\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger', 'data' => [
                'confirm' => 'Are you sure you want to delete this item?', 'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model, 'attributes' => [
            'id', 'reply_ids', 'content_id', 'user_id', 'user_name', 'user_email:email', 'user_url:url', 'user_ip',
            'user_address', 'content:ntext', 'created_at', 'status',
        ],
    ]) ?>

</div>
