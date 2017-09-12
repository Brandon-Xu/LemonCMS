<?php

namespace source\modules\post\models;

use source\models\ConfigForm;
use source\modules\post\PostInfo;

class Setting extends ConfigForm
{
    public function _init() {
        $this->setBelongModule(new PostInfo());
    }
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
