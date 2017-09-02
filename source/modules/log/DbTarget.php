<?php

namespace source\modules\log;

use source\libs\Utility;
use source\LuLu;

class DbTarget extends \yii\log\DbTarget
{
    public function getMessagePrefix($message) {
        if ($this->prefix !== NULL) {
            return call_user_func($this->prefix, $message);
        }

        $ip = Utility::getIp();

        $userID = LuLu::getIdentity()->username;
        if (empty($userID)) {
            return "[$ip]";
        } else {
            return "[$ip]<br/>[$userID]";
        }


    }

}
