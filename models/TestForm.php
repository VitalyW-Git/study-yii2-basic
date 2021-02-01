<?php
// для работы с формой отправки на email расширяем класс yii\base\Model
// для работы с формой CRUD базы данных расширяем класс yii\elasticsearch\ActiveRecord,

namespace app\models;
use yii\db\ActiveRecord;

// передаём созданный объект с полями в контроллер страницы
// для создания форм мы используем 2 класса ActiveForm и ActiveField
class TestForm extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    // название полей для формы можно задать через модель для всех созданных views
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-mail',
            'text' => 'Текст сообщения',
        ];
    }
//    валидатопы полей обязательные для заполнения
// если одно поле не указано в валидации оно не будет загружено на сервер
    public function rules()
    {
        return [
            [ ['name', 'text'] , 'required'],
            ['email', 'safe'],
        ];
    }
}