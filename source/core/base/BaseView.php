<?php

namespace source\core\base;

use source\core\widgets\LoopData;
use source\libs\DataSource;
use source\LuLu;
use source\traits\Common;
use yii\base\UnknownPropertyException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @property array $breadcrumbs
 * @property array $toolbar
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

    /**
     * @return array
     */
    public function getBreadcrumbs(){
        return isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
    }

    /**
     * @param array|string $bc
     */
    public function setBreadcrumbs($bc){
        $this->params['breadcrumbs'] = [];
        foreach ($bc as $item){
            if(is_array($item)){
                $label  = isset($item[0]) ? $item[0] : NULL;
                $url    = isset($item[1]) ? $item[1] : [];
                $tp     = isset($item[2]) ? $item[2] : NULL;
                $encode = isset($item[3]) ? $item[3] : TRUE;
                if($label !== NULL){
                    $this->addBreadcrumb($label, $url, $tp, $encode);
                }
            }else if (is_string($item)){
                $this->addBreadcrumb($item);
            }
        }
    }

    /**
     * @param $label
     * @param array $url
     * @param null $template
     * @param bool $encode
     */
    public function addBreadcrumb($label, $url = [], $template = NULL, $encode = TRUE){
        $item = [ 'label' => $label ];

        if(!empty($url)){
            $item['url'] = $url; }

        if(!empty($template)){
            $item['template'] = $template; }

        if(count($item) > 1){
            $item['encode'] = $encode; }

        $item = count($item) === 1 ? $item['label'] : $item;
        $this->params['breadcrumbs'][] = $item;
    }

    public function getToolbar(){
        $defaultToolbarItem = [
            Html::a(\Yii::t('app', 'Back'), app()->request->referrer, ['class' => 'btn btn-warning']),
        ];
        return isset($this->params['toolbar']) ? $this->params['toolbar'] : $defaultToolbarItem;
    }

    /**
     * @param array $toolbar
     */
    public function setToolbar($toolbar){
        $this->params['toolbar'] = $toolbar;
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
        $currentTheme = ltrim($currentTheme, app()->basePath);
        $currentTheme = str_replace('/', '\\', $currentTheme);
        if (\source\libs\Common::classExist($currentTheme)) {
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
