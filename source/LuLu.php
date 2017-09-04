<?php

namespace source;

use source\core\modularity\ModuleService;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\VarDumper;

require_once __DIR__.'/libs/functions.php';

class LuLu extends \Yii
{

    public static function getApp() {
        return app();
    }

    public static function getView() {
        return app()->getView();
    }

    public static function getRequest() {
        return app()->request;
    }

    public static function getResponse() {
        return app()->response;
    }

    public static function getBaseUrl($url = NULL) {
        $baseUrl = app()->request->getBaseUrl();
        if ($url !== NULL) {
            $baseUrl .= $url;
        }

        return $baseUrl;
    }

    public static function getHomeUrl($url = NULL) {
        $homeUrl = app()->getHomeUrl();
        if ($url !== NULL) {
            $homeUrl .= $url;
        }

        return $homeUrl;
    }

    public static function getWebUrl($url = NULL) {
        $webUrl = self::getAlias('@web');
        if ($url !== NULL) {
            $webUrl .= $url;
        }

        return $webUrl;
    }

    public static function getWebPath($path = NULL) {
        $webPath = self::getAlias('@webroot');
        if ($path !== NULL) {
            $webPath .= $path;
        }

        return $webPath;
    }

    public static function getAppParam($key, $defaultValue = NULL) {
        if (array_key_exists($key, app()->params)) {
            return app()->params[$key];
        }

        return $defaultValue;
    }

    public static function setAppParam($array) {
        foreach ($array as $key => $value) {
            app()->params[$key] = $value;
        }
    }

    public static function getViewParam($key, $defaultValue = NULL) {
        $view = app()->getView();
        if (array_key_exists($key, $view->params)) {
            return $view->params[$key];
        }

        return $defaultValue;
    }

    public static function setViewParam($array) {
        $view = app()->getView();
        foreach ($array as $name => $value) {
            $view->params[$name] = $value;
        }
    }

    public static function hasGetValue($key) {
        return isset($_GET[$key]);
    }

    /**
     *
     * @param string $key a or a/b/c
     * @param string $default
     * @return string
     */
    public static function getGetValue($key, $default = NULL) {
        $data = $_GET;

        $keys = explode('/', $key);
        foreach ($keys as $key) {
            if (is_array($data) && key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                return $default;
            }
        }

        if ($data === NULL) {
            return $default;
        }

        return $data;
    }

    public static function hasPostValue($key) {
        return isset($_POST[$key]);
    }

    public static function getPostValue($key, $default = NULL) {
        $data = $_POST;

        $keys = explode('/', $key);
        foreach ($keys as $key) {
            if (is_array($data) && key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                return $default;
            }
        }

        if ($data === NULL) {
            return $default;
        }

        return $data;
    }

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
        app()->session->setFlash($type, $message);
    }

    public static function setWarningMessage($message) {
        self::setFlash('warning', $message);
    }

    public static function setSuccessMessage($message) {
        self::setFlash('success', $message);
    }

    public static function setErrorMessage($message) {
        self::setFlash('error', $message);
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

    public static function getCache($key) {
        return app()->cache->get($key);
    }

    public static function setCache($key, $value, $duration = 0, $dependency = NULL) {
        return app()->cache->set($key, $value, $duration, $dependency);
    }

    public static function deleteCache($key) {
        app()->cache->delete($key);
    }

    public static function flushCache() {
        app()->cache->flush();
    }

    public static function getUser() {
        return app()->user;
    }

    public static function getIdentity() {
        $identity = app()->user->getIdentity();
        if (empty($identity)) {
            $identity = new \source\models\User();
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

            return app()->getResponse()->redirect(Url::to($loginUrl), 302);
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
