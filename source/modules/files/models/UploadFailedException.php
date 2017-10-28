<?php
/**
 * User: BrandonXu
 */

namespace source\modules\files\models;

use Symfony\Component\Translation\Exception\ExceptionInterface;

class UploadFailedException extends \InvalidArgumentException implements ExceptionInterface
{

    public function __construct($code = 0) {
        $message = $this->message($code);
        parent::__construct($message, $code);
    }

    private function message($code) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => \Yii::t('app', "The uploaded file exceeds the upload_max_filesize directive in php.ini"),
            UPLOAD_ERR_FORM_SIZE => \Yii::t('app', "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"),
            UPLOAD_ERR_PARTIAL => \Yii::t('app', "The uploaded file was only partially uploaded"),
            UPLOAD_ERR_NO_FILE => \Yii::t('app', "No file was uploaded"),
            UPLOAD_ERR_NO_TMP_DIR => \Yii::t('app', "Missing a temporary folder"),
            UPLOAD_ERR_CANT_WRITE => \Yii::t('app', "Failed to write file to disk"),
            UPLOAD_ERR_EXTENSION => \Yii::t('app', "File upload stopped by extension"),
        ];

        if (isset($errors[$code])) {
            return $errors[$code];
        }

        return \Yii::t('app', "Unknown upload error");
    }

}