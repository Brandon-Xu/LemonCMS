<?php

namespace source;

use source\core\modularity\ModuleService;
use source\models\User;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\VarDumper;

require_once __DIR__.'/libs/functions.php';

class LuLu extends \Yii
{



    public static function getFlash($type, $default = NULL) {
        $flash = app()->session->getFlash($type, $default);
        if ($flash === NULL) {
            $flash = [];
        }
        if (is_string($flash)) {
            $flash = [$flash];
        }

        return $flash;
    }

    public static function setFlash($type, $message, $append = TRUE) {
        if ($append) {
            $flash = self::getFlash($type);
            if (is_string($message)) {
                $flash[] = $message;
            } else if (is_array($message)) {
                $flash = array_merge($flash, $message);
            } else if ($message === NULL) {
                $flash = NULL;
            }
            $message = $flash;
        }
    }

    public static function setWarningMessage($message) {
        app()->session->setFlash('warning', $message);
    }

    public static function setSuccessMessage($message) {
        app()->session->setFlash('success', $message);
    }

    public static function setErrorMessage($message) {
        app()->session->setFlash('error', $message);
    }

    public static function error($message, $category = 'application') {
        parent::error($message, $category);
        self::setErrorMessage($message);
    }

    public static function warning($message, $category = 'application') {
        parent::warning($message, $category);
        self::setWarningMessage($message);
    }

    public static function info($var, $category = 'application') {
        $dump = VarDumper::dumpAsString($var);
        parent::info($dump, $category);
    }

    public static function debug($var, $category = 'application') {
        $dump = VarDumper::dumpAsString($var);
        parent::info($dump, $category);
    }



    public static function setCache($key, $value, $duration = 0, $dependency = NULL) {
        return app()->cache->set($key, $value, $duration, $dependency);
    }

    public static function deleteCache($key) {
        app()->cache->delete($key);
    }

    public static function getUser() {
        return app()->user;
    }

    public static function getIdentity() {
        $identity = app()->user->getIdentity();
        if (empty($identity)) {
            $identity = new User();
        }

        return $identity;
    }

    public static function getIsGuest() {
        return app()->user->isGuest;
    }

    public static function checkIsGuest($loginUrl = NULL) {
        $isGuest = app()->user->isGuest;
        if ($isGuest) {
            if ($loginUrl == FALSE) {
                return FALSE;
            }
            if ($loginUrl == NULL) {
                $loginUrl = [
                    'site/login',
                ];
            }

            return app()->response->redirect(Url::to($loginUrl), 302);
        }

        return TRUE;
    }

    public static function checkAuth($permissionName, $params = [], $allowCaching = TRUE) {
        return app()->user->can($permissionName, $params, $allowCaching);
    }

    public static function getDB() {
        return app()->db;
    }

    public static function createCommand($sql = NULL) {
        if ($sql !== NULL)
            return app()->db->createCommand($sql);

        return app()->db->createCommand();
    }

    public static function execute($sql) {
        return self::createCommand($sql)->execute();
    }

    public static function queryAll($sql) {
        return self::createCommand($sql)->queryAll();
    }

    public static function queryOne($sql) {
        return self::createCommand($sql)->queryOne();
    }

    /**
     *
     * @param \yii\db\ActiveQuery $query
     * @param array $config ['db','page','pageSize','orderBy','rows','pager']
     * @return array
     */
    public static function getPagedRows($query, $config = []) {
        $db = isset($config['db']) ? $config['db'] : NULL;

        $countQuery = clone $query;
        $pager = new Pagination([
            'totalCount' => $countQuery->count('*', $db),
        ]);
        if (isset($config['page'])) {
            $pager->setPage($config['page'], TRUE);
        }

        if (isset($config['pageSize'])) {
            $pager->setPageSize($config['pageSize'], TRUE);
        }

        $rows = $query->offset($pager->offset)->limit($pager->limit);

        if (isset($config['orderBy'])) {
            $rows = $rows->orderBy($config['orderBy']);
        }
        $rows = $rows->all($db);

        $rowsLable = isset($config['rows']) ? $config['rows'] : 'rows';
        $pagerLable = isset($config['pager']) ? $config['pager'] : 'pager';

        $ret = [];
        $ret[$rowsLable] = $rows;
        $ret[$pagerLable] = $pager;

        return $ret;
    }

    public static function getService($id) {
        $id = $id.'Service';
        $component = app()->get($id, TRUE);
        if ($component instanceof ModuleService) {
            return $component;
        }
        throw new InvalidParamException("get service:$id");
    }

    public static function go($url) {
        $url = Url::to($url);
        exit('<script>top.location.href="'.$url.'"</script>');
    }
}
