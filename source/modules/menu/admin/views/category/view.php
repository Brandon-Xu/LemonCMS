<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\menu\models\MenuCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menu Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-category-view">

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
            'id', 'name', 'description',
        ],
    ]) ?>

</div>
