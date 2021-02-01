<?php
// для работы с формой отправки на email расширяем класс yii\base\Model
// для работы с формой CRUD базы данных расширяем класс yii\elasticsearch\ActiveRecord,

namespace app\models;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{
    // изменения запроса к таблице базы данных не по нозванию обекта
    public static function tableName()
    {

        return 'categories';
    }
    // ССЫЛКА НА ОБЪЕКТ Product
    public function getProducts()
    {
        return $this->hasMany( Product::className(), ['parent' => 'id'] );
    }

}