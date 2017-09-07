<?php

namespace source\models;

use source\core\base\BaseActiveRecord;
use source\modules\taxonomy\models\Taxonomy;

/**
 * This is the model class for table "lulu_content".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $body
 *
 */
class ContentBody extends BaseActiveRecord
{

    public function getTaxonomy() {
        return $this->hasOne(Taxonomy::className(), ['id' => 'taxonomy_id']);
    }

    public function getHead() {
        return $this->hasOne(Content::className(), ['id' => 'content_id']);
    }
}
