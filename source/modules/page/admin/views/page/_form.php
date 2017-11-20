<?php

use source\core\widgets\ActiveForm;use source\libs\Constants;

/* @var $this source\core\base\BaseView */
/* @var $model source\models\Content */
/* @var $form ActiveForm */

$taxonomy = $this->config()->get('taxonomy', \source\modules\page\PageInfo::getId());

$form = ActiveForm::begin(); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
            <?= $form->field($model, 'title')->textInput() ?>
            <?= $form->field($model, 'sub_title')->textInput() ?>
            <?= $form->field($model, 'url_alias')->textInput() ?>
            <?= $form->field($model, 'redirect_url')->textInput() ?>
            <?= $form->field($model->body, 'body')->widget('source\assets\UEditor');?>
            <?= $form->field($model, 'summary')->textarea() ?>
            <?= $form->field($model, 'thumb')->fileInput() ?>
		</div>

		<div class="col-md-4">
			<div class="da-panel">
				发布
				<div class="da-panel-content">
					<div class="da-form-row da-form-block">
                        <?= $form->field($model, 'taxonomy_id')->dropDownListTree(app()->taxonomy->getTree($taxonomy, 0, FALSE)) ?>
                        <?= $form->field($model, 'recommend')->dropDownList(Constants::getRecommendItems()) ?>
                        <?= $form->field($model, 'headline')->dropDownList(Constants::getHeadlineItems()) ?>
                        <?= $form->field($model, 'sticky')->dropDownList(Constants::getStickyItems()) ?>
                        <?= $form->field($model, 'status')->dropDownList(Constants::getStatusItemsForContent()) ?>
                        <?= $form->field($model, 'visibility')->dropDownList(Constants::getVisibilityItems()) ?>
                        <?= $form->field($model, 'allow_comment')->dropDownList(Constants::getYesNoItems()) ?>
					</div>
				</div>
			</div>

			<div class="da-panel collapsible collapsed">
				<div class="da-panel-header">
					<span class="da-panel-title">
						属性设置
					</span>
				</div>

				<div class="da-panel-content">
                    <?= $form->field($model, 'sort_num')->textInput() ?>
				</div>
			</div>
			<div class="da-panel collapsible collapsed">
				<div class="da-panel-header">
					<span class="da-panel-title">
						SEO设置
					</span>
				</div>

				<div class="da-panel-content">
                    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => 256]) ?>
                    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => 256]) ?>
                    <?= $form->field($model, 'seo_description')->textarea(['maxlength' => 256, 'rows' => 5]) ?>

				</div>
			</div>
			<div class="da-panel collapsible collapsed">
				<div class="da-panel-header">
					<span class="da-panel-title">
						模板设置
					</span>
				</div>

				<div class="da-panel-content">
                    <?= $form->field($model, 'view')->textInput(['maxlength' => 64]) ?>
                    <?= $form->field($model, 'layout')->textInput(['maxlength' => 64]) ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>