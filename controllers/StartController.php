<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;
use app\models\TestForm;

class StartController extends Controller
{
    public $layout = 'newtmp'; // переключаем вывод шаблона чеез controller /web/index.php?r=start/index
    // /web/index.php?r=start/index
    public function actionIndex()
    {
        if ( Yii::$app->request->isAjax ){
//            print_r($_POST);
            Yii::$app->request->post(); // выводим результат запроса
            return 'Запрос принят!';
        }
        // объект с формой передаём во views
        $model = new TestForm;
        if ( $model->load( Yii::$app->request->post() ) )
        {
//            var_dump(Yii::$app->request->post());exit();
//            проверяем отправленную формы и выводим собщение об отправке
            if ( $model->validate() ) {
                Yii::$app->session->setFlash('success', 'Данные приняты.');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка!');
            }
        }


        $this->view->title= 'Все статьи !';
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => 'добавленный keywords']);
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'добавленный description']);

        return $this->render('index', compact('model'));
    }
    public function actionShow()
    {
//        $this->layout = 'newtmp'; // переключение щаблона только для actionIndex()
        $this->view->title = 'Одна статья !';
        return $this->render('show'); // без переключения шаблона index будет использовать шаблон main
    }


}