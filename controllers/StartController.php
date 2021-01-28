<?php


namespace app\controllers;


use yii\web\Controller;
use Yii;

class StartController extends Controller
{
    public $layout = 'newtmp'; // переключаем вывод шаблона чеез controller /web/index.php?r=start/index
    // /web/index.php?r=start/index
    public function actionIndex()
    {
        if ( Yii::$app->request->isAjax ){
            print_r($_GET);
            return 'test';
        }
        return $this->render('index');
    }
    public function actionShow()
    {
//        $this->layout = 'newtmp'; // переключение щаблона только для actionIndex()
        return $this->render('show'); // без переключения шаблона index будет использовать шаблон main
    }
}