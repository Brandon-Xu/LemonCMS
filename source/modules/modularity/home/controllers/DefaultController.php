<?php

namespace source\modules\post\home;

use source\models\Content;
use source\modules\post\models\ContentPost;


class DefaultController extends BaseController
{

    public function getDetail($id) {
        $model = Content::getBodyByClass(ContentPost::className(), ['a.id' => $id])->one();

        return ['model' => $model];
    }
}
