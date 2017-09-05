<?php

namespace source\modules\taxonomy;

use source\core\modularity\ModuleService;
use source\modules\taxonomy\models\Taxonomy;
use source\modules\taxonomy\models\TaxonomyCategory;
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
            'Taxonomy' => Taxonomy::className(), 'TaxonomyCategory' => TaxonomyCategory::className(),
        ];

        $value = ArrayHelper::getValue($items, $model);
        if(empty($value)){
            throw new UnknownClassException('unknown model');
        }
        return $value;
    }
}
