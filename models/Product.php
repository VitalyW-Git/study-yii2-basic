<?php
// для работы с формой отправки на email расширяем класс yii\base\Model
// для работы с формой CRUD базы данных расширяем класс yii\elasticsearch\ActiveRecord,

namespace app\models;
use yii\db\ActiveRecord;


class Product extends ActiveRecord
{
// изменения запроса к таблице базы данных не по нозванию обекта
    public static function tableName()
    {

        return 'products';
    }

//    public function getCategories()
//    {
//        return $this->hasMany( Category::className(), ['id' => 'parent'] );
//    }
}