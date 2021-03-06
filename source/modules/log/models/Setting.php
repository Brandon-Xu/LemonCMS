<?php

namespace source\modules\log\models;

use yii\helpers\ArrayHelper;

class Setting extends \source\models\ConfigForm
{

    public $test1;
    public $test2;

    public function rules() {
        return [
            [['test1', 'test2'], 'required'], [['test1', 'test2'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels() {
        return [
            'test1' => 'test1 label', 'test2' => 'test2 label',
        ];
    }

}
