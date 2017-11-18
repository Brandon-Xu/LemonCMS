<?php

namespace source\modules\taxonomy;

use source\core\modularity\ModuleService;
use source\modules\taxonomy\models\Taxonomy;
use source\modules\taxonomy\models\TaxonomyCategory;
use yii\base\Model;
use yii\widgets\ActiveForm;
use yii\base\UnknownClassException;
use yii\helpers\ArrayHelper;

class TaxonomyService extends ModuleService
{

    public function getServiceId() {
        return 'taxonomyService';
    }

    public function getTaxonomyCategories() {
        $categories = TaxonomyCategory::findAll([], 'name asc');

        return $categories;
    }

    public function getTaxonomiesAsTree($category) {
        return Taxonomy::getArrayTree($category);
    }

    public function getTaxonomyById($id, $default = TRUE) {
        $taxonomyModel = Taxonomy::getTaxonomyById($id);
        if ($taxonomyModel === NULL && $default === TRUE) {
            $taxonomyModel = new Taxonomy();
            $taxonomyModel->id = -1;
            $taxonomyModel->name = '所有';
        }

        return $taxonomyModel;
    }

    public function getModel($model) {
        $items = [
            'Taxonomy'           => Taxonomy::className(),
            'TaxonomyCategory'   => TaxonomyCategory::className(),
        ];

        $value = ArrayHelper::getValue($items, $model);
        if(empty($value)){
            throw new UnknownClassException('unknown model');
        }
        return $value;
    }




    /**
     * @param null $categoryId
     * @param int $parentId
     * @param bool $asArray
     * @return Taxonomy[]
     */
    public function getTree($categoryId = NULL, $parentId = 0, $asArray = TRUE){
        $query = Taxonomy::find();
        if( $asArray ===  TRUE){ $query->asArray(); }
        return $query->getTree($categoryId, $parentId);
    }

    /**
     * 递归返回树状下拉菜单选项
     * @param ActiveForm $form
     * @param Taxonomy $model
     * @param string $attribute
     * @param Taxonomy[] $taxonomies
     * @return string
     */
    public function dropDownListTree($form, $model, $attribute, $taxonomies){
        $items = [];
        /**
         * 递归函数
         * Recursively Function
         * @param Taxonomy $taxonomy
         * @param string $tab
         */
        $rec = function(Taxonomy $taxonomy, $tab = '') use (&$items, &$rec){
            $preStr = empty($tab) ? '' : "$tab|---";
            $items[$taxonomy->id] = $preStr.$taxonomy->name;
            $tab .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if (!empty($taxonomy->subTaxonomy)){
                foreach ($taxonomy->subTaxonomy as $subTaxonomy){ $rec($subTaxonomy, $tab); }
            }
        };

        foreach ($taxonomies as $key => $taxonomy){
            $rec($taxonomy);
        }

        return $form->field($model, $attribute)->dropDownList($items, [
            'encode'=>FALSE,
            'options' => [
                $model->id => [
                    'disabled' => TRUE
                ]
            ]
        ]);
    }
}
