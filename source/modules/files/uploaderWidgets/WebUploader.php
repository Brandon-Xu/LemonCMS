<?php
/**
 * User: BrandonXu
 * Date: 2017/10/24
 * Time: 19:17
 */
namespace source\modules\files\uploaderWidgets;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

class WebUploader extends InputWidget
{

    public static $autoIdPrefix = 'w_up_';

    public $btnText = 'Click to upload';

    public $fileVal = NULL;
    /**
     * @var bool $upMultiFile 只允许上传单个文件还是允许上传多个文件， 默认只传一张
     */
    public $upMultiFile = FALSE;

    /**
     * @var string $server 文件上传的地址
     */
    public $server;

    public $auto = TRUE;

    public $accept = [
        'title'         => 'Images',
        'extensions'    => 'gif,jpg,jpeg,bmp,png',
        'mimeTypes'     => 'image/*'
    ];

    public function init() {
        parent::init();
        \source\assets\WebUploader::register($this->getView());
        $this->fileVal = 'fileUploader';
        if (empty($this->server)){
            $this->server = Url::to(['/admin/files/upload']);
        }
    }

    /**
     * @return string
     */
    public function run() {
        $this->renderJs();

        $fileBox = ($this->upMultiFile) ? $this->renderMultiFile() : $this->renderSingleFile();
        $btn = $this->renderBtn();
        $input = $this->renderInput();
        $content = $fileBox.$btn.$input;

        return Html::tag('div', $content, ['id'=>'box_'.$this->id, 'class'=>'fileUploader']);
    }

    public function renderJs(){
        $config = [
            'auto'      => $this->auto,
            'server'    => $this->server,
            'pick'      => '#'.$this->id,
            'accept'    => $this->accept,
            'fileVal'   => $this->fileVal,
            'duplicate' => TRUE,
        ];

        $config = Json::encode($config);
        $this->getView()->registerJs("var {$this->id} = WebUploader.create($config);", View::POS_READY);
    }

    /**
     * @return string
     */
    public function renderBtn(){
        return Html::tag('div', \Yii::t('app', $this->btnText), [
            'id' => $this->id
        ]);
    }

    public function renderInput(){
        return Html::activeHiddenInput($this->model, $this->attribute);
    }

    public function renderSingleFile(){
        $this->view->registerCss('
        .file-box { width: 100%; float: left;margin-bottom: 5px; }
        .file-box .item { float:left; width: 30%; padding-right: 3.3333333% }
        .file-box img { display: block; width: 100%; }
        ');

        $file = $this->renderItem();
        return Html::tag('div', $file, ['class'=>'file-box']);
    }

    public function renderMultiFile(){
        return Html::tag('div', '', ['class'=>'file-box']);
    }

    public function renderItem(){
        $file = '';
        $value = $this->model->{$this->attribute};
        if(!empty($value)){
            $file = Html::img(Url::to(['/'.$value]), ['class'=>'img-thumbnail']);
        }
        return Html::tag('div', $file, ['class'=>'item']);
    }

}