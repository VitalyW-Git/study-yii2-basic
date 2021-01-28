<?php

namespace app\controllers\admin;

use yii\web\Controller;

// вложенный controller админка
class UserController extends Controller
{
    // index.php?r=admin/user/index
    public function actionIndex()
    {
        return $this->render('index');
    }


}