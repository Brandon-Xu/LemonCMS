<?php
/**
 * User: BrandonXu
 * Date: 2017/9/2
 * Time: 20:28
 */

namespace source\core\rest;

use yii;
use yii\data\ActiveDataProvider;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexAction extends yii\rest\IndexAction
{

    public $prepareDataProvider;

    public function run() {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->prepareDataProvider();
    }

    protected function prepareDataProvider() {
        if ($this->prepareDataProvider !== NULL) {
            return call_user_func($this->prepareDataProvider, $this);
        }

        /* @var $modelClass \source\modules\post\models\ContentPost */
        $modelClass = $this->modelClass;

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $modelClass::find()->with(['head', 'head.taxonomy'])->asArray(),
        ]);
    }
}