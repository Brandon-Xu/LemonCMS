<?php

namespace source\modules\rbac\rules;

use source\LuLu;

class ControllerRule extends Rule
{

    public function execute($permission, $params = [], $role = NULL) {
        $actionId = isset($params[ 'actionId' ]) ? $params[ 'actionId' ] : LuLu::getApp()->requestedAction->id;

        $actions = $permission[ 'value' ];
        if (in_array($actionId, $actions)) {
            return TRUE;
        }

        $method = LuLu::getApp()->request->method;
        $method = strtolower($method);
        if (in_array($actionId.':'.$method, $actions)) {
            return TRUE;
        }

        return FALSE;
    }
}