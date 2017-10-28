<?php

use source\core\widgets\ActiveForm;
use source\libs\Constants;
use source\libs\TreeHelper;
use source\LuLu;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $model source\models\Content */
/* @var $form yii\widgets\ActiveForm */

$filedOptions = [];
$taxonomy = $this->config()->get('taxonomy', \source\modules\post\PostInfo::getId());
$taxonomies = app()->taxonomy->getTaxonomiesAsTree($taxonomy);
$options = TreeHelper::buildTreeOptions($taxonomies);

/* @var $form source\core\widgets\ActiveForm */

$form = ActiveForm::begin(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">

                <?= $form->field($model, 'title', $filedOptions)->textInput([
                    'maxlength' => 256,
                    'placeholder' => $this->t('Please input title'),
                ]) ?>
                <?= $form->field($model, 'sub_title', $filedOptions)->textInput([
                    'maxlength' => 256,
                    'placeholder' => $this->t('Please input sub title'),
                ]) ?>
                <!-- @todo
                <?= $form->field($model, 'url_alias', $filedOptions)->textInput([
                    'maxlength' => 256,
                    'placeholder' => $this->t('Url address'),
                ]) ?>
                <?= $form->field($model, 'redirect_url', $filedOptions)->textInput(['maxlength' => 256]) ?>
                -->

                <?= $form->field($model->body, 'body')->widget('source\assets\UEditor'); ?>

                <?= $form->field($model, 'summary', $filedOptions)->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'thumb')
                    ->hint(!empty($model->thumb) ? Html::img(\yii\helpers\Url::to('/'.$model->thumb), ['style' => ['max-width' => '200px']]) : '')
                    ->fileInput(['class' => 'da-custom-file']) ?>

                <?= $form->field($model, 'thumb2')
                    ->hint(!empty($model->thumb2) ? Html::img(\yii\helpers\Url::to('/'.$model->thumb2), ['style' => ['max-width' => '200px']]) : '')
                    ->fileInput(['class' => 'da-custom-file']) ?>

            </div>
            <div class="col-md-4">
                <div class="nav-tabs-custom row">
                    <?php echo \yii\bootstrap\Tabs::widget([
                        'items' => [
                            [
                                'label' => 'One',
                                'content' => 'Anim pariatur cliche...',
                                'active' => TRUE,
                            ],
                            [
                                'label' => 'Two',
                                'content' => 'Anim pariatur cliche...',
                                'options' => ['id' => 'myveryownID'],
                            ],
                        ],
                    ]) ?>

                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#tab_1-1" data-toggle="tab">Tab 1</a></li>
                        <li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>
                        <li><a href="#tab_3-2" data-toggle="tab"><?= $this->t('Property Setting') ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1-1">
                            <?= $form->field($model, 'taxonomy_id')->dropDownList($options) ?>
                            <div class="da-form-row da-form-block">
                                <?= $form->field($model, 'recommend')->dropDownList(Constants::getRecommendItems()) ?>
                                <?= $form->field($model, 'headline')->dropDownList(Constants::getHeadlineItems()) ?>
                                <?= $form->field($model, 'sticky')->dropDownList(Constants::getStickyItems()) ?>
                                <?= $form->field($model, 'status')->dropDownList(Constants::getStatusItemsForContent()) ?>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-2">
                            <div class="da-form-row da-form-block">
                                <?= $form->field($model, 'visibility', [
                                    'options' => ['class' => 'da-form-col-4-12'],
                                ])->dropDownList(Constants::getVisibilityItems()) ?>
                                <?= $form->field($model, 'allow_comment', [
                                    'options' => ['class' => 'da-form-col-4-12 omega'],
                                ])->dropDownList(Constants::getYesNoItems()) ?>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3-2">
                            <?= $form->field($model, 'sort_num', [
                                'options' => ['class' => 'da-form-row da-form-block'],
                            ])->textInput() ?>

                            <div class="da-panel-content">
                                <?= $form->field($model, 'seo_title', [
                                    'options' => ['class' => 'da-form-row da-form-block'],
                                ])->textInput(['maxlength' => 256]) ?>
                                <?= $form->field($model, 'seo_keywords', [
                                    'options' => ['class' => 'da-form-row da-form-block'],
                                ])->textInput(['maxlength' => 256]) ?>
                                <?= $form->field($model, 'seo_description', [
                                    'options' => ['class' => 'da-form-row da-form-block'],
                                ])->textarea([
                                    'maxlength' => 256,
                                    'rows' => 5,
                                ]) ?>
                                <div class="da-panel collapsible collapsed">
                                    <div class="da-panel-header">模板设置</div>
                                    <div class="da-panel-content">
                                        <?= $form->field($model, 'view', [
                                            'options' => ['class' => 'da-form-row da-form-block'],
                                        ])->textInput(['maxlength' => 64]) ?>
                                        <?= $form->field($model, 'layout', [
                                            'options' => ['class' => 'da-form-row da-form-block'],
                                        ])->textInput(['maxlength' => 64]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>