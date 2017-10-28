<?php

namespace source\modules\files;

use source\core\modularity\ModuleService;
use source\modules\files\uploaderWidgets\WebUploader;

class FilesService extends ModuleService
{

    public function getServiceId() {
        return 'filesService';
    }

    public function getUploaderList(){
        return [
            WebUploader::className(),
        ];
    }

    public function getUploader(){

    }

    public function fileInput($model, $attribute, $options){
        return WebUploader::widget([
            'model' => $model,
            'attribute' => $attribute,
            'options' => $options
        ]);
    }
}
