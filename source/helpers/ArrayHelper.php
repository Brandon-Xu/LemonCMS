<?php

namespace yii\helpers;

use yii\base\InvalidParamException;

class ArrayHelper extends BaseArrayHelper
{

    /**
     * @param $items array
     * @param null $key
     * @param bool $throw
     * @return array
     */
    public static function getItems($items, $key = NULL, $throw = FALSE) {
        if ($key !== NULL) {
            if (key_exists($key, $items)) {
                return $items[$key];
            }
            if ($throw) {
                throw new InvalidParamException();
            }
            throw new InvalidParamException('unknown key:'.$key);
        }

        return $items;
    }
}