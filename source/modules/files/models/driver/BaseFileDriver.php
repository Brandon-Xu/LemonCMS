<?php
namespace source\modules\files\models\driver;

use Carbon\Carbon;
use source\modules\files\models\Files;
use source\modules\files\models\UploadFailedException;
use yii\base\Component;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * User: BrandonXu
 */
abstract class BaseFileDriver extends Component implements IFileDriver
{

    public function upload($formName) {
        $fileInstance = UploadedFile::getInstanceByName($formName);
        if($fileInstance === NULL) return FALSE;

        $this->beforeUpload($fileInstance);

        $fileModel = $this->doUpload($fileInstance);

        $this->afterUpload($fileModel);
        $fileModel->save();

        return $fileModel;
    }

    public function doUpload(UploadedFile $file) {
        $ymd = date("Ymd");
        $save_path = \Yii::getAlias('@attachment').'/'.$ymd."/";
        $save_url = '/attachment/'.$ymd."/";

        if (!file_exists($save_path)) {
            mkdir($save_path);
        }

        $fileMd5 = md5_file($file->tempName);
        $exist = Files::findOne(['id'=>$fileMd5]);
        if ($exist){
            // 如果发现文件已存在则删除零时文件
            unlink($file->tempName);
            return $exist;
        }

        $filename = date("YmdHis").'_'.rand(10000, 99999).'.'.$file->getExtension();
        $targetPath = $save_path.$filename;
        $file->saveAs($targetPath);

        $fileModel = new Files();
        $fileModel->id = $fileMd5;
        $fileModel->driver = self::className();
        $fileModel->extension = $file->extension;
        $fileModel->size = $file->size;
        $fileModel->type = $file->type;
        $fileModel->filename = $filename;
        $fileModel->basename = $file->baseName;
        $fileModel->uploaderId = app()->user->id;
        $fileModel->basePath = $save_url.$filename;
        $fileModel->absUrl = Url::to(app()->request->baseUrl.$fileModel->basePath, TRUE);
        $fileModel->created_at = Carbon::now()->timestamp;
        $fileModel->created_date = $ymd;


        return $fileModel;
    }

    /**
     * @param UploadedFile $file
     */
    public function beforeUpload(UploadedFile $file) {
        if ($file->hasError) {
            throw new UploadFailedException($file->error);
        }
    }

    /**
     * @param Files $file
     */
    public function afterUpload(Files &$file) {

    }

    /**
     * 删除文件
     * @param string $path
     * @return bool
     */
    public function delFile($path) {
        $path = \Yii::getAlias('@web/'.$path);
        \Yii::info('Delete File: '.$path);
        return @unlink($path);
    }
}