<?php

namespace source\core\base;

use source\LuLu;
use source\traits\CommonTrait;
use Yii;
use yii\base\InvalidRouteException;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    use CommonTrait;

    public function behaviors() {
        return [];
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ], 'captcha' => [
                'class' => 'yii\captcha\CaptchaAction', // 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'height' => '40', 'width' => '100', 'minLength' => 3, 'maxLength' => 5,
            ],
        ];
    }


    public function init() {
        parent::init();

        $this->getView()->on(BaseView::EVENT_BEGIN_PAGE, [
            $this, 'beginPage',
        ]);
        $this->getView()->on(BaseView::EVENT_BEGIN_BODY, [
            $this, 'beginBody',
        ]);
        $this->getView()->on(BaseView::EVENT_BEFORE_RENDER, [
            $this, 'beforeRender',
        ]);
        $this->getView()->on(BaseView::EVENT_AFTER_RENDER, [
            $this, 'afterRender',
        ]);
        $this->getView()->on(BaseView::EVENT_END_BODY, [
            $this, 'endBody',
        ]);
        $this->getView()->on(BaseView::EVENT_END_PAGE, [
            $this, 'endPage',
        ]);
        $this->getView()->on(BaseView::EVENT_AFTER_PAGE, [
            $this, 'afterPage',
        ]);
        LuLu::getResponse()->on(Response::EVENT_AFTER_SEND, [
            $this, 'afterResponse',
        ]);
    }

    public function jsonResponse($data, $status = NULL, $message = '') {
        $ret = [
            'status' => $status, 'message' => $message, 'data' => $data,
        ];
        $response = \Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = $ret;

        return $response;
    }

    public function jsonSucceedResponse($data, $message = '') {
        return $this->jsonResponse($data, 'succeed', $message);
    }

    public function jsonFailedResponse($data, $message = '') {
        return $this->jsonResponse($data, 'failed', $message);
    }

    /**
     * 执行一个action
     * @param string $id
     * @param array $params
     * @return mixed|ActionResult
     * @throws InvalidRouteException
     */
    public function runAction($id, $params = []) {
        $action = $this->createAction($id);
        if ($action === NULL) {
            throw new InvalidRouteException('Unable to resolve the request: '.$this->getUniqueId().'/'.$id);
        }

        Yii::trace("Route to run: ".$action->getUniqueId(), __METHOD__);

        if (Yii::$app->requestedAction === NULL) {
            Yii::$app->requestedAction = $action;
        }

        $oldAction = $this->action;
        $this->action = $action;

        $modules = [];
        $runAction = TRUE;

        foreach ($this->getModules() as $module) {
            if ($module->beforeAction($action)) {
                array_unshift($modules, $module);
            } else {
                $runAction = FALSE;
                break;
            }
        }

        $actionResult = new ActionResult();
        $actionResult->controller = $this;
        $actionResult->action = $action;

        $result = $this->beforeAction($action);
        if ($runAction && $result === TRUE) {
            $actionResult->isExecuted = TRUE;
            $actionResult->result = $action->runWithParams($params);
        } else {
            $actionResult->isExecuted = FALSE;
            $actionResult->result = $result;
        }

        $actionResult = $this->afterAction($action, $actionResult);

        foreach ($modules as $module) {
            $actionResult = $module->afterAction($action, $actionResult);
        }

        $this->action = $oldAction;

        return $actionResult;
    }

    public function findLayoutFile($view) {
        if (($view instanceof BaseView) && !empty($view->layout)) {
            $oldLayout = $this->layout;
            $this->layout = $view->layout;
            $file = parent::findLayoutFile($view);
            $this->layout = $oldLayout;

            return $file;
        } else {
            return parent::findLayoutFile($view);
        }
    }

    public function beginPage($event) { }

    public function beginBody($event) { }

    public function beforeRender($event) { }

    public function afterRender($event) { }

    public function endBody($event) { }

    public function endPage($event) { }

    public function afterPage($event) { }

    public function afterResponse($event) { }
}
