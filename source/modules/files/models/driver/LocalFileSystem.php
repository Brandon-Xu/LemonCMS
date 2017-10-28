<?php

namespace source\modules\files\models\driver;


/**
 * User: BrandonXu
 * Date: 2017/10/25
 * Time: 17:34
 */
class LocalFileSystem extends BaseFileDriver
{

    /**
     * @return string
     */
    public function getDriverInfo() {
        return \Yii::t('app', 'Local file system');
    }


    /**
     * @return array
     */
    public function getFolders() {
        return [];
    }

    /**
     * Create target folder and return folder path
     * @param string $path
     * @return string
     */
    public function setFolder($path = NULL) {
        return '';
    }

    /**
     * 获取文件列表
     * @param array $searchParams
     * @param int $limit
     * @param int $offset
     * @return \source\modules\files\models\Files[]
     */
    public function getFiles($searchParams = [], $limit = 18, $offset = 0) {
        return [];
    }

}
