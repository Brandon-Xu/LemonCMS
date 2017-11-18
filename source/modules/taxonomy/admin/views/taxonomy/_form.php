<?php

use source\core\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\taxonomy\models\Taxonomy */
/* @var $form source\core\widgets\ActiveForm */
$this->toolbar = [
    Html::a('返回', ['index', 'category' => $category], ['class' => 'btn btn-primary']),
];

$form = ActiveForm::begin();

$this->beginBlock('template');
echo $form->field($model, 'list_view')->textInput(['maxlength' => 64]);
echo $form->field($model, 'list_layout')->textInput(['maxlength' => 64]);
echo $form->field($model, 'detail_view')->textInput(['maxlength' => 64]);
echo $form->field($model, 'detail_layout')->textInput(['maxlength' => 64]);
$this->endBlock();

$this->beginBlock('seo');
echo $form->field($model, 'seo_title')->textInput(['maxlength' => 256]);
echo $form->field($model, 'seo_keywords')->textInput(['maxlength' => 256]);
echo $form->field($model, 'seo_description')->textarea(['maxlength' => 256]);
$this->endBlock();

$tabs = \yii\bootstrap\Tabs::widget([
    'options' => ['class' => 'pull-right'],
    'items' => [
        [
            'label' => '模板设置',
            'content' => $this->blocks['template'],
        ],
        [
            'label' => 'SEO设置',
            'content' => $this->blocks['seo'],
            'active' => TRUE,
        ],
    ],
]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php
            echo $form->field($model, 'parent_id')->dropDownListTree(app()->taxonomy->getTree($model->category_id, 0, FALSE));
            echo $form->field($model, 'name')->textInput(['maxlength' => 64]);
            echo $form->field($model, 'url_alias')->textInput(['maxlength' => 64]);
            echo $form->field($model, 'redirect_url')->textInput(['maxlength' => 128]);
            echo $form->field($model, 'thumb')->fileInput();
            echo $form->field($model, 'description')->textarea(['maxlength' => 256]);
            echo $form->field($model, 'page_size')->textInput();
            echo $form->field($model, 'sort_num', ['options' => ['style' => 'border-bottom: 0;']])->textInput(); ?>
        </div>
        <div class="col-md-4">
            <div class="nav-tabs-custom" style="box-shadow: none"><?= $tabs; ?></div>
        </div>
    </div>
<?php ActiveForm::end();