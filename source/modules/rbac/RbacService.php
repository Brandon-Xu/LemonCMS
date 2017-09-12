<?php

namespace source\modules\rbac;

use source\core\modularity\ModuleService;
use source\libs\Utility;
use source\LuLu;
use source\models\User;
use source\modules\rbac\models\Assignment;
use source\modules\rbac\models\Permission;
use source\modules\rbac\models\Relation;
use source\modules\rbac\models\Role;
use yii\base\UnknownClassException;
use yii\db\Query;
use yii\rbac\Rule;

class RbacService extends ModuleService
{

    const CachePrefix = 'rbac_';

    private $assignmentTable;

    private $roleTable;

    private $permissionTable;

    private $relationTable;

    private $ruleNamespace = '\source\modules\rbac\rules\\';

    public function init() {
        parent::init();
        $this->auth = app()->authManager;

        $this->assignmentTable = Assignment::tableName();
        $this->roleTable = Role::tableName();
        $this->permissionTable = Permission::tableName();
        $this->relationTable = Relation::tableName();
    }

    public function getServiceId() {
        return 'rbacService';
    }

    public function getRolesByUser($username) {
        if ($username === LuLu::getIdentity()->username) {

            $role = LuLu::getIdentity()->role;
        } else {
            $user = User::findOne(['username' => $username]);
            $role = $user->role;
        }

        return $role;

        //         $query = new Query();
        //         $query->select([
        //             'r.id',
        //             'r.category',
        //             'r.name',
        //             'r.description',
        //             'r.is_system',
        //             'r.sort_num'
        //         ]);
        //         $query->from([
        //             'r' => $this->roleTable,
        //             'a' => $this->assignmentTable
        //         ]);
        //         $query->where('r.id=a.role');
        //         $query->andWhere([
        //             'a.user' => $username
        //         ]);
        //         $rows = $query->indexBy('id')->all();
        //         return $rows;
    }

    public function getPermissionsByUser($username = NULL) {
        $role = $this->getRolesByUser($username);

        return $this->getPermissionsByRole($role);

        //        //for assignmentTable
        //         $query = new Query();
        //         $query->select([
        //             'p.id',
        //             'p.category',
        //             'p.name',
        //             'p.description',
        //             'p.form',
        //             'p.default_value',
        //             'p.rule',
        //             'p.sort_num',
        //             'r.role',
        //             'r.value'
        //         ]);
        //         $query->from([
        //             'p' => $this->permissionTable,
        //             'r' => $this->relationTable,
        //             'a' => $this->assignmentTable
        //         ]);
        //         $query->where('p.id=r.permission and r.role=a.role');
        //         $query->andWhere([
        //             'a.user' => $user
        //         ]);
        //         $rows = $query->all();
        //         return $this->convertPermissionValue($rows);
    }

    public function getPermissionsByRole($role, $fromCache = TRUE) {
        $cacheKey = self::CachePrefix.$role;

        $value = $fromCache ? LuLu::getCache($cacheKey) : FALSE;
        if ($value === FALSE) {
            $query = new Query();
            $query->select([
                'p.id', 'p.category', 'p.name', 'p.description', 'p.form', 'p.default_value', 'p.rule', 'p.sort_num',
                'r.role', 'r.value',
            ]);
            $query->from([
                'p' => $this->permissionTable, 'r' => $this->relationTable,
            ]);
            $query->where('r.permission = p.id');
            $query->andWhere([
                'r.role' => $role,
            ]);
            $rows = $query->all();
            $value = $this->convertPermissionValue($rows);

            LuLu::setCache($cacheKey, $value);
        }

        return $value;
    }

    private function convertPermissionValue($rows) {
        $ret = [];
        if ($rows === NULL) {
            return $ret;
        }
        foreach ($rows as $row) {
            $form = intval($row['form']);
            if ($form === Permission::Form_Boolean) {
                $v = Utility::isTrue($row['value']);
            } else if ($form === Permission::Form_CheckboxList) {
                $v = explode(',', $row['value']);
            } else {
                $v = $row['value'];
            }
            $row['value'] = $v;
            $ret[$row['id']][] = $row;
        }

        return $ret;
    }

    public function checkPermission($permission = NULL, $params = [], $username = NULL) {
        if (empty($permission)) {
            $permission = app()->controller->uniqueId;
        }
        if (empty($username)) {
            $username = LuLu::getIdentity()->username;
        }
        $rows = $this->getPermissionsByUser($username);

        if (!isset($rows[$permission])) {
            return FALSE;
        }

        return $this->executeRule($rows[$permission], $params, $username);
    }

    public function checkHomePermission($permission = NULL, $params = [], $user = NULL) {
        if ($user === NULL) {
            $user = LuLu::getIdentity()->username;
        }
        if ($permission === NULL) {
            $permission = app()->controller->uniqueId;
        }
        $permission = 'home_'.$permission;

        $rows = $this->getPermissionsByUser($user);

        if (!isset($rows[$permission])) {
            return FALSE;
        }

        return $this->executeRule($rows[$permission], $params, $user);
    }

    private function executeRule($permission, $params = [], $user) {
        if (is_array($permission)) {
            foreach ($permission as $p) {
                if (empty($p['rule'])) {
                    return TRUE;
                }
                $ruleClass = $this->ruleNamespace.$p['rule'];

                $ruleInstance = new $ruleClass();
                $ret = $ruleInstance->execute($p, $params, $user);
                if ($ret === TRUE) {
                    return TRUE;
                }
            }

            return FALSE;
        } else {
            if (empty($permission['rule'])) {
                return TRUE;
            }

            $ruleClass = $this->ruleNamespace.$permission['rule'];

            $ruleInstance = new $ruleClass();

            return $ruleInstance->execute($permission, $params, $user);
        }
    }

    public function getAllRoles() {
        return Role::buildOptions();
    }


    /** --------------------上面是快要去屎的代码------------------------- */

    /** @var \yii\rbac\ManagerInterface $auth */
    public $auth;

    /**
     * @param $name
     * @param $description
     * @param Rule|string $rule
     * @return \yii\rbac\Permission
     */
    public function addPermission($name, $description = NULL, $rule = NULL){
        $item = $this->auth->getPermission($name);
        if(!$item){
            $item = $this->auth->createPermission($name);
            $item->description = $description;
            $rule = (is_string($rule) && class_exists($rule)) ? new $rule() : $rule;
            if(is_object($rule) && $rule instanceof Rule){
                $item->ruleName = $rule->name;
            }
            $this->auth->add($item);
        }
        return $item;
    }

    /**
     * @param $parent
     * @param $child
     * @return bool
     */
    public function addChild($parent, $child){
        if (is_string($parent)){
            $parent = $this->auth->getPermission($parent); }
        if (is_string($child)){
            $child = $this->auth->getPermission($child); }
        if(!$this->auth->hasChild($parent, $child)){
            $this->auth->addChild($parent, $child);
        }
        return TRUE;
    }

    /**
     * @param $ruleClassName
     * @return Rule
     * @throws UnknownClassException
     */
    public function addRule($ruleClassName){
        if(!class_exists($ruleClassName)) throw new UnknownClassException('不存在的 rule class');
        /** @var Rule $ruleObj */
        $ruleObj = new $ruleClassName;
        $name = $ruleObj->name;
        $rule = $this->auth->getRule($name);
        if(!$rule){
            $this->auth->add($ruleObj);
            $rule = $ruleObj;
        }
        return $rule;
    }

    public function addRole($name, $description = NULL){
        $role = $this->auth->getRole($name);
        if(!$role) {
            $role = $this->auth->createRole($name);
            $role->description = $description;
            $this->auth->add($role);
        }
        return $role;
    }

    public function assign($item, $userId){
        if(is_string($item)){
            $item = $this->addRole($item); }
        $assignments = $this->auth->getAssignments($userId);
        if(!isset($assignments[$item->name])){
            $this->auth->assign($item, $userId);
        }
    }
}
