<?php
namespace source\core\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

class CommonBehavior extends AttributeBehavior
{
    public $validates = [];
    public $inserts = [];
    public $updates = [];

    public function init() {
        parent::init();

        if (!empty($this->validates)) {
            $this->attributes[BaseActiveRecord::EVENT_BEFORE_VALIDATE] = $this->validates;
        }
        if (!empty($this->inserts)) {
            $this->attributes[BaseActiveRecord::EVENT_BEFORE_INSERT] = $this->inserts;
        }
        if (!empty($this->updates)) {
            $this->attributes[BaseActiveRecord::EVENT_BEFORE_UPDATE] = $this->updates;
        }
    }

}