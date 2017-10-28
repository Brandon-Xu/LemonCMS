<?php

namespace source\modules\i18n;

use source\core\modularity\ModuleInfo;

class I18nInfo extends ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'i18n';
        $this->name = '国际化模块';
        $this->version = '1.0';
        $this->description = '提供各国语言的翻译内容';

        $this->is_system = TRUE;
    }
}
