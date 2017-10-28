<?php
/**
 * User: BrandonXu
 * Date: 2017/10/25
 * Time: 17:22
 */
namespace source\modules\files\models\driver;

interface IFileDriver
{

    /**
     * @return string
     */
    public function getDriverInfo();

    /**
     * @param string $formName
     * @return \source\modules\files\models\Files
     */
    public function upload($formName);

    /**
     * @return array
     */
    public function getFolders();

    /**
     * Create target folder and return folder path
     * @param string $path
     * @return string
     */
    public function setFolder($path = NULL);

    /**
     * 获取文件列表
     * @param array $searchParams
     * @param int $limit
     * @param int $offset
     * @return \source\modules\files\models\Files[]
     */
    public function getFiles($searchParams = [], $limit = 18, $offset = 0);

    /**
     * 删除文件
     * @param string $path
     * @return bool
     */
    public function delFile($path);
}