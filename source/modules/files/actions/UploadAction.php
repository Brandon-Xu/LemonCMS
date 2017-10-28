<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/10/24
 * Time: 20:10
 */

namespace source\modules\files\actions;

use source\modules\files\models\driver\IFileDriver;
use yii\base\InvalidCallException;
use yii\base\UnknownClassException;
use yii\rest\Action;
use yii\web\Response;

class UploadAction extends Action
{

    public $modelClass = 'source\modules\files\models\Files';

    public $uploadDrive = 'source\modules\files\models\driver\LocalFileSystem';

    public $formName = 'fileUploader';

    public function run() {
        if (class_exists($this->uploadDrive)) {
            $uploadDriver = new $this->uploadDrive;
            if($uploadDriver instanceof IFileDriver){
                $file = $uploadDriver->upload($this->formName);
                if($file !== FALSE){
                    return $file->getAttributes(['id', 'type', 'filename', 'extension', 'basename', 'basePath', 'absUrl' ]);
                }
                throw new InvalidCallException(\Yii::t('app', 'No file upload'));
            } else {
                throw new InvalidCallException('文件上传驱动类必须继承接口：IFileDriver');
            }
        } else {
            throw new UnknownClassException('Unknown Class :' .$this->uploadDrive);
        }
    }

}