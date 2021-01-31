<?php
// для работы с формой отправки на email расширяем класс yii\base\Model
// для работы с формой CRUD базы данных расширяем класс yii\elasticsearch\ActiveRecord,

namespace app\models;
use yii\base\Model;

// передаём созданный объект с полями в контроллер страницы
// для создания форм мы используем 2 класса ActiveForm и ActiveField
class TestForm extends Model
{
    public $name;
    public $email;
    public $text;

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
//            [ ['name', 'email'] , 'required'],
//            ['name', 'required', 'message' => 'поле Имя должно быть заполнено'],
            [ 'name', 'required' ], // обязательно поле для заполненя
            [ 'email', 'required' ], // обязательно поле для заполненя
//            валидация email адреса
            ['email', 'email'],
//            минимальное число символов 2, обязательно указываем string
//            ['name', 'string', 'min' => 2],
//            ['name', 'string', 'max' => 5],
            [ 'name', 'string', 'length' => [2, 5] ],
            [ 'name', 'validateName' ], // public function validateName( $attr )
            [ 'text', 'trim' ],
        ];
    }
//    валидация на сервере
    public function validateName( $attr )
    {
        if (!in_array($this->$attr, [ 'hello', 'world' ])) {
            $this->addError($attr, 'Выбирете одно из этих значений "hello" или "world".');
        }
    }
}