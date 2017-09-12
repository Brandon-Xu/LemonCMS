<?php

namespace source\modules\page\models;

use source\models\ConfigForm;

class Setting extends ConfigForm
{

    public $taxonomy;

    public function rules() {
        return [
            [
                ['taxonomy'], 'string',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'taxonomy' => '绑定分类',
        ];
    }
}
