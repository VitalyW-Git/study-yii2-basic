<?php

namespace app\components\widget;

use yii\base\Widget;

class BucketModelUserWidget extends Widget
{

    public function run()
    {
        return $this->render('model-bucket');
    }

}