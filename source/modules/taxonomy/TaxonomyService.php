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
        return TaxonomyCategory::find()->all();
    }

    public function getTaxonomyById($id) {
        return Taxonomy::findOne(['id'=>$id]);
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
     * @return Taxonomy|Model[]
     */
    public function getTree($categoryId = NULL, $parentId = 0, $asArray = TRUE){
        $query = Taxonomy::find();
        if( $asArray ===  TRUE){ $query->asArray(); }
        return $query->getTree($categoryId, $parentId);
    }

}
