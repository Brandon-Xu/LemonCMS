<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/9/7
 * Time: 21:35
 */

namespace source\core\rbac;

use source\models\Content;
use yii\rbac\Rule;

class AuthorRule extends Rule
{

    public $name = 'isAuthor';

    public function execute($userId, $item, $params) {
        /** @var Content $item */
        $item = @array_pop($params);
        return !empty($item) ? $item->user_id == $userId : FALSE;
    }
}