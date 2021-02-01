<?php


namespace app\controllers;


use Yii;
use app\models\Category;
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

//        $data = TestForm::findOne(3);
//        $data->email = 'text@text.com';// ручное изменение данных
//        $data->save();
//        $data->delete(); //удаление записи

//        TestForm::deleteAll( ['>', 'id', 3] ); //параметры для удаления
//        TestForm::deleteAll();// удалит всё

        // объект с формой передаём во views
        $model = new TestForm;
//        $model->name = 'Автор'; // ручная загрузка данных
//        $model->email = 'mail@mail.ru';
//        $model->text = 'Текст сообщения';
//        $model->save();

        // автомотическая загрузка данных
        if ( $model->load( Yii::$app->request->post() ) )
        {
//            var_dump(Yii::$app->request->post());exit();
//            проверяем отправленную формы и выводим собщение об отправке
            if ( $model->save() ) {
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
//          СОЗДАНИЕ ЗАПРОСОВ БАЗЫ ДАННЫХ
//        $dat = Category::find()->all();
//        $dat = Category::find()->orderBy(['id' => SORT_DESC])->all(); //SORT_DES Cсортировка в обратном порядке и SORT_ASC обычная
//        $dat = Category::find()->asArray()->all(); // выводит в виде массива
//        $dat = Category::find()->asArray()->where('parent = 691')->all(); // получаем все поля с номером 691
//        $dat = Category::find()->asArray()->where( ['parent' => 691] )->all(); // получаем все поля с номером 691
//        $dat = Category::find()->asArray()->where( ['like', 'title', 'pp'] )->all(); // выведет весь текст с pp пример Apple
//        $dat = Category::find()->asArray()->where( ['<=', 'id', 695] )->all();
//        $dat = Category::find()->asArray()->where( ['parent' => 691] )->limit(1)->all(); //выведет одну запись
//        $dat = Category::find()->asArray()->where( ['parent' => 691] )->limit(1)->one(); //выведет одну запись
//        $dat = Category::find()->asArray()->where( ['parent' => 691] )->count(); // выводит количество записей
//        $dat = Category::findOne( ['parent' => 691] ); // одна запись
//        $dat = Category::findAll( ['parent' => 691] ); // все записи

//        $get = "SELECT * FROM categories WHERE title LIKE '%pp%'";
//        $dat = Category::findBySql($get)->all();

//        $get = "SELECT * FROM categories WHERE title LIKE :search"; // безопасный запрос выносим параметр в массив
//        $dat = Category::findBySql($get, [':search' => '%pp%'])->all();
//          ОДИН КО МНОГИМ
//        $dat = Category::findOne(694); // линивая зангрузка
//        $dat = Category::find()->with('products')->where('id = 694')->all(); // жадная загрузка
//        $dat = Category::find()->all(); // отложенная загрузка

        $dat = Category::find()->with('products')->all(); // жадная загрузка

        return $this->render('show', compact('dat')); // без переключения шаблона index будет использовать шаблон main
    }


}