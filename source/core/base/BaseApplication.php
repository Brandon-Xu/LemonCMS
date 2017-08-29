<?php

namespace source\core\base;

use source\LuLu;
use Yii;
use yii\base\InvalidRouteException;
use yii\helpers\FileHelper;
use source\traits\CommonTrait;
use source\libs\Common;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UrlNormalizerRedirectException;

/**
 *
 * @property \source\modules\modularity\ModularityService $modularityService
 * @property \source\modules\rbac\RbacService $rbacService
 * @property \source\modules\taxonomy\TaxonomyService $taxonomyService
 * @property \source\modules\menu\MenuService $menuService
 *
 */
class BaseApplication extends \yii\web\Application
{
    use CommonTrait;

    public $activeModules = [];

    public function init() {
        parent::init();
        Common::setTimezone();
    }

    public function loadActiveModules($isAdmin) {
        $moduleManager = $this->modularityService;

        $this->activeModules = $moduleManager->getActiveModules($isAdmin);

        $module = $isAdmin ? 'admin\AdminModule' : 'home\HomeModule';

        foreach ($this->activeModules as $m) {
            $moduleId = $m[ 'id' ];
            $moduleDir = $m[ 'dir' ];
            $ModuleClassName = $m[ 'dir_class' ];

            $this->setModule($moduleId, [
                'class' => 'source\modules\\'.$moduleDir.'\\'.$module
            ]);

            $serviceFile = LuLu::getAlias('@source').'\modules\\'.$moduleDir.'\\'.$ModuleClassName.'Service.php';
            if (FileHelper::exist($serviceFile)) {
                $serviceClass = 'source\modules\\'.$moduleDir.'\\'.$ModuleClassName.'Service';
                $serviceInstance = new $serviceClass();
                $this->set($serviceInstance->getServiceId(), $serviceInstance);
            }
        }
    }

    public function handleRequest($request) {
        if (empty($this->catchAll)) {
            try {
                list ($route, $params) = $request->resolve();
                /*
                * @todo 如果以后要开源出去的话这块得在文档里写一下
                * copy 自 createController 方法中的代码，根据 url 获取其中的 module 模块名
                * 然后尝试引入模块，如果模块存在并成功引入，则会自动执行模块中的 init() 方法
                * 以达到在模块文件中另行添加 urlManager 里的 Rules 的目的，而不需要在配置文
                * 件里就写完所有 url 规则
                */
                $loadModuleAndRunInit = function ($route) {
                    if (strpos($route, '/') !== FALSE) {
                        list ($id, $route) = explode('/', $route, 2);
                    } else {
                        $id = $route;
                        $route = '';
                    }
                    return $this->getModule($id);
                };
                if ($loadModuleAndRunInit($route) !== NULL) {
                    list($route, $params) = $request->resolve();
                }
            } catch (UrlNormalizerRedirectException $e) {
                $url = $e->url;
                if (is_array($url)) {
                    if (isset($url[ 0 ])) {
                        // ensure the route is absolute
                        $url[ 0 ] = '/'.ltrim($url[ 0 ], '/');
                    }
                    $url += $request->getQueryParams();
                }

                return $this->getResponse()->redirect(Url::to($url, $e->scheme), $e->statusCode);
            }
        } else {
            $route = $this->catchAll[ 0 ];
            $params = array_splice($this->catchAll, 1);
        }
        try {
            LuLu::trace("Route requested: '$route'", __METHOD__);
            $this->requestedRoute = $route;
            $actionsResult = $this->runAction($route, $params);
            $result = $actionsResult instanceof ActionResult ? $actionsResult->result : $actionsResult;
            if ($result instanceof Response) {
                return $result;
            } else {
                $response = $this->getResponse();
                if ($result !== NULL) {
                    $response->data = $result;
                }

                return $response;
            }
        } catch (InvalidRouteException $e) {
            throw new NotFoundHttpException(Yii::t('yii', 'Page not found.'), $e->getCode(), $e);
        }
    }
}
