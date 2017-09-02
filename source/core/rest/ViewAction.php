<?php
/**
 * User: BrandonXu
 * Date: 2017/9/2
 * Time: 20:28
 */
namespace source\core\rest;

use source\models\Content;
use yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ViewAction extends yii\rest\ViewAction
{

    public $prepareDataProvider;

    /**
     * Displays a model.
     * @param string $id the primary key of the model.
     * @return \yii\db\ActiveRecordInterface the model being displayed
     */
    public function run($id)
    {
        $model = $this->findModel($id);
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id, $model);
        }

        if ($this->prepareDataProvider !== NULL) {
            return call_user_func($this->prepareDataProvider, $id);
        }
        return $model;
    }

}