<?php

namespace source\modules\rbac\rules;

class BooleanRule extends Rule
{

    public function execute($permission, $params = [], $role = NULL) {
        if ($permission[ 'value' ]) {
            return TRUE;
        }

        return FALSE;
    }
}