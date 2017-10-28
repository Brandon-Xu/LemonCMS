<?php
/**
 * User: BrandonXu
 */

namespace source\modules\files\admin\controllers;

use frontend\controllers\BaseRestController;

class UploadController extends BaseRestController
{

    public $defaultAction = 'index';
    public $modelClass = 'source\modules\files\models\Files';


    public function actions() {
        return [
            'index' => [
                'class' => 'source\modules\files\actions\UploadAction',
            ]
        ];
    }

    protected function verbs() {
        return [
            'index' => ['POST'],
        ];
    }
}