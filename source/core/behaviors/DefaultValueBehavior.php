<?php
namespace source\core\behaviors;

class DefaultValueBehavior extends CommonBehavior
{
    public $empty;

    public function evaluateAttributes($event)
    {
        if (!empty($this->attributes[$event->name])) {
            $attributes = (array) $this->attributes[$event->name];
            $value = $this->getValue($event,$attributes);
            foreach ($attributes as $attribute) {

                // ignore attribute names which are not string (e.g. when set by TimestampBehavior::updatedAtAttribute)
                if (!is_string($attribute)) {
                    continue;
                }
                if($this->empty instanceof \Closure)
                {
                    if($this->empty($this->owner->$attribute))
                    {
                        $this->owner->$attribute = $value;
                    }
                }
                else
                {
                    if( $this->owner->$attribute===null|| $this->owner->$attribute==='')
                    {
                        $this->owner->$attribute = $value;
                    }
                }
            }
        }
    }
}