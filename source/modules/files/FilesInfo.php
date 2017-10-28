<?php

namespace source\modules\files;

use source\core\modularity\ModuleInfo;

class FilesInfo extends ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'files';
        $this->name = '文件模块';
        $this->version = '1.0';
        $this->description = '文件管理模块，可上传文件并进行统一管理，提供上传接口';

        $this->is_system = TRUE;
    }
}
