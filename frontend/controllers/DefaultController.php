<?php
/**
 * User: BrandonXu
 * Date: 2017/9/13
 * Time: 21:34
 */

namespace frontend\controllers;

use moonland\phpexcel\Excel;
use source\modules\zjut\models\ZjutUsers;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout = FALSE;

    public function actionIndex(){
        return $this->render('emptyHtml');
    }

    /*
    public function actionData(){

        $zjut = new ZjutUsers;
        $zjutAtt = $zjut->attributes;
        unset($zjutAtt['id']);
        $zjutAtt = array_keys($zjutAtt);


        $s = \Yii::getAlias('@attachment/zjut.xls');

        $data = Excel::import($s, [
            'setFirstRecordAsKeys' => true,
            'setIndexSheetByName' => true,
            'getOnlySheet' => '按班级',
        ]);

        $items = [];
        foreach ($data as $k => $item){
            unset($item['']);
            if(isset($item['移动电话']) && !empty($item['移动电话']) && $item['移动电话'] !== '移动电话'){
                $items[] = array_values($item);
            }
            unset($data[$k]);
        }

        $s = app()->db->createCommand()->batchInsert(ZjutUsers::tableName(), $zjutAtt, $items);


        dd($s->execute());
    }
    */
}