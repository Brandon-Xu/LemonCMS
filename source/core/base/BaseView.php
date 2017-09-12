<?php

namespace source\core\base;

use source\core\widgets\LoopData;
use source\libs\DataSource;
use source\LuLu;
use source\traits\Common;
use yii\base\UnknownPropertyException;
use yii\helpers\Url;
use yii\web\View;

/**
 *
 * @property \source\modules\modularity\ModularityService $modularityService
 * @property \source\modules\rbac\RbacService $rbacService
 * @property \source\modules\taxonomy\TaxonomyService $taxonomyService
 * @property \source\modules\menu\MenuService $menuService
 *
 */
class BaseView extends View
{
    use Common;

    const EVENT_AFTER_PAGE = 'afterPage';

    public $layout = NULL;
    public $themeBundle;

    public function init() {
        parent::init();
    }

    public function assetsUrl($url = ''){
        if(empty($this->themeBundle)){
            throw new UnknownPropertyException('themeBundle must be set');
        }
        $baseUrl = $this->themeBundle->baseUrl.'/';
        return Url::to($baseUrl.$url);
    }

    public function getHomeUrl($url = NULL) {
        return LuLu::getHomeUrl($url);
    }

    public function addBreadcrumbs($items) {
        foreach ($items as $item) {
            if (is_array($item)) {
                if (isset($item[2])) {
                    $this->params['breadcrumbs'][] = [
                        'label' => $item[0], 'url' => $item[1], 'img' => $item[2],
                    ];
                } else {
                    $this->params['breadcrumbs'][] = [
                        'label' => $item[0], 'url' => $item[1],
                    ];
                }
            } else {
                $this->params['breadcrumbs'][] = $item;
            }
        }
    }

    public function getDataSource($where = NULL, $orderBy = NULL, $limit = 10, $options = []) {
        $datas = DataSource::getContents($where, $orderBy, $limit, $options);

        return $datas;
    }

    public function loopData($dataSource, $item, $appendOptions = []) {
        $options = [];
        $options['dataSource'] = $dataSource;
        $options['item'] = $item;

        echo LoopData::widget($options);
    }

    public function beginLoopData($dataSource, $item, $appendOptions = []) {
        $options = [];
        $options['dataSource'] = $dataSource;
        $options['item'] = $item;

        return LoopData::begin($options);
    }

    public function endLoopData() {
        LoopData::end();
    }

    public function beginWidget($name, $opitons = []) {
        return $name::begin($opitons);
    }

    public function endWidget($name) {
        $name::end();
    }

    public function showWidget($name, $params) {
        $currentTheme = \Yii::getAlias('@activeTheme/misc/'.$name);
        if (class_exists($currentTheme)) {
            echo $currentTheme::widget($params);
        } else {
            echo 'the widget '.$name.' does not exist';
        }
    }

    public function showPager($params) {
        $this->showWidget('LinkPager', $params);
    }

    public function endPage($ajaxMode = FALSE) {
        parent::endPage($ajaxMode);
        $this->afterPage();
    }

    public function afterPage() {
        $this->trigger(self::EVENT_AFTER_PAGE);
    }
}
